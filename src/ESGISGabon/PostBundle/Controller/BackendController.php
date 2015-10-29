<?php

namespace ESGISGabon\PostBundle\Controller;

use BluEstuary\CoreBundle\Model\CRUD;
use Doctrine\Common\Persistence\ObjectManager;
use ESGISGabon\PostBundle\Entity\Category;
use ESGISGabon\PostBundle\Entity\CorporatePost;
use ESGISGabon\PostBundle\Entity\Keyword;
use ESGISGabon\PostBundle\Form\CategoryType;
use ESGISGabon\PostBundle\Form\CorporatePostType;
use ESGISGabon\PostBundle\Form\KeywordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    public function indexAction(Request $request)
    {
        $router = $this->get('router');
        $routeOptions = array();

        $page = $request->query->get('page');
        $by_author = $request->query->get('by_author');
        $by_category = $request->query->get('category');
        $by_keyword = $request->query->get('keyword');

        if(!is_null($page))
            $routeOptions['page'] = $page;
        if(!is_null($by_author))
            $routeOptions['by_author'] = $by_author;
        if(!is_null($by_category))
            $routeOptions['category'] = $by_category;
        if(!is_null($by_keyword))
            $routeOptions['keyword'] = $by_keyword;

        $post_repo = $this->getDoctrine()->getManager()->getRepository('ESGISGabonPostBundle:CorporatePost');
        $posts_count = $post_repo->countPosts();

        return $this->render('ESGISGabonPostBundle:Backend:allposts.html.twig', array(
            'page_title' => 'Tous les articles',
            'posts_count' => $posts_count,
            'apiGetPostsUrl' => $router->generate('api_get_posts', $routeOptions),
            'baseApiGetPostsUrl' => $router->generate('api_get_posts')
        ));
    }

    public function addPostAction()
    {
        $currentUser = $this->getUser();

        if(is_null($currentUser))
            throw new \RuntimeException('User token missing.');

        $postTypeStandard = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('ESGISGabonPostBundle:PostType')
                                ->findOneBy(array('slug' => 'standard'));

        $corporate_post = new CorporatePost();
        $corporate_post->setPostType($postTypeStandard);
        $corporate_post->setOwner($currentUser);

        return $this->AddOrEditPost($corporate_post, 'Ajouter un nouvel article');
    }

    public function editPostAction(CorporatePost $post)
    {
        return $this->AddOrEditPost($post, "Modifier l'article", PostCRUD::UPDATE);
    }

    public function removePostAction(CorporatePost $post)
    {
        return new Response("remove post");
    }

    public function showPostAction(CorporatePost $post)
    {
        return new Response("show post");
    }

    public function categoriesAction()
    {
        $category = new Category();

        return $this->AddOrEditCategory($category, "Catégories");
    }

    public function editCategoryAction(Category $category)
    {
        return $this->AddOrEditCategory($category, "Catégories", CRUD::UPDATE);
    }

    public function loadCategoriesAction()
    {

        $categoryManager = $this->get('blu_es_post.category_manager');

        $categoriesTree = $categoryManager->loadAllCategories();

        return $this->render('@ESGISGabonPost/Backend/categories_table.html.twig', array(
            'categories' => $categoriesTree
        ));
    }

    public function deleteCategoryAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        if('POST' == $request->getMethod()){
            $category_id_list = $request->request->get('category_id_list');
            $table_actions = $request->request->get('table_actions')[0];

            $category_id_array = empty($category_id_list) ? null : explode(',', $category_id_list);

            if(!is_null($category_id_array)){
                $i = 0;
                $e = 0;
                foreach($category_id_array as $category_id){

                    $category = $em->getRepository('ESGISGabonPostBundle:Category')->find(intval($category_id));
                    if($category){
                        $this->doDeleteCategory($category, $em);
                        $i++;
                    } else
                        $e++;
                }
                if($i > 0){
                    $em->flush();

                    $this->get('session')
                        ->getFlashBag()
                        ->add('success_info', $i.' catégorie(s) supprimée(s).');
                }
                if($e > 0){
                    $this->get('session')
                        ->getFlashBag()
                        ->add('error_info', $e.' élément(s) non reconnu(s).');
                }
            }else{
                $this->get('session')
                    ->getFlashBag()
                    ->add('warning_info', 'Aucune catégorie supprimée.');
            }
        }
        return $this->redirect($this->generateUrl('esgis_gabon_admin_categories'));
    }

    public function keywordsAction()
    {
        $keyword = new Keyword();

        return $this->AddOrEditKeyword($keyword, "Mots-clés", CRUD::CREATE);
    }

    public function editKeywordAction(Keyword $keyword)
    {
        return $this->AddOrEditKeyword($keyword, "Mots-clés", CRUD::UPDATE);
    }

    public function loadKeywordsAction()
    {
        $keywordManager = $this->get('blu_es_post.tag_manager');

        $keywords = $keywordManager->loadAllTags();

        return $this->render('@ESGISGabonPost/Backend/keywords_table.html.twig', array(
            'keywords' => $keywords
        ));
    }

    public function deleteKeywordAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        if('POST' == $request->getMethod()){
            $keywords_id_list = $request->request->get('keywords_id_list');
            $table_actions = $request->request->get('table_actions')[0];

            $keywords_id_array = empty($keywords_id_list) ? null : explode(',', $keywords_id_list);

            if(!is_null($keywords_id_array)){
                $i = 0;
                $e = 0;
                foreach($keywords_id_array as $keyword_id){
                    $keyword = $em->getRepository('ESGISGabonPostBundle:Keyword')->find(intval($keyword_id));

                    if($keyword){
                        $this->doDeleteKeyword($keyword, $em);
                        $i++;
                    }else
                        $e++;
                }
                if($i > 0){
                    $em->flush();

                    $this->get('session')
                        ->getFlashBag()
                        ->add('success_info', $i.' mots-clés supprimé(s).');
                }
                if($e > 0){
                    $this->get('session')
                        ->getFlashBag()
                        ->add('error_info', $e.' élément(s) non reconnu(s).');
                }
            }else {
                $this->get('session')
                    ->getFlashBag()
                    ->add('warning_info', 'Aucun mot-clé supprimé.');
            }
        }
        return $this->redirect($this->generateUrl('esgis_gabon_admin_keywords'));
    }


    /*======= Protected =======*/

    protected function AddOrEditKeyword(Keyword $keyword, $pageTitle, $actionType = CRUD::CREATE)
    {
        $form = $this->createForm(new KeywordType(), $keyword);

        $request = $this->get('request');

        if('POST' == $request->getMethod()) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $keywordManager = $this->get('blu_es_post.tag_manager');

                // slugify keyword name
                $keywordManager->tagSlugify($keyword);

                // persis and flush the new or updated category
                $em->persist($keyword);
                $em->flush();

                if($request->isXmlHttpRequest()){
                    return new JsonResponse(array(
                        'result' => 'success',
                        'message' => $keywordManager->generateSuccessMessage($keyword, $actionType)
                    ));
                }

                $this->get('session')
                    ->getFlashBag()
                    ->add('success_info', $keywordManager->generateSuccessMessage($keyword, $actionType));

                if(CRUD::CREATE === $actionType)
                    $this->redirect($this->generateUrl('esgis_gabon_admin_keywords'));
            }
            if($request->isXmlHttpRequest()){
                return new JsonResponse(array(
                    'result' => 'error',
                    'message' => $form->getErrorsAsString()
                ));
            }

        }
        $renderOptions = array(
            'page_title' => $pageTitle,
            'form' => $form->createView(),
            'action_type' => $actionType
        );

        if($actionType === CRUD::CREATE){

            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_keywords');
            $renderOptions['form_title'] = "Ajouter une nouveau mot-clé";

        } else if($actionType === CRUD::UPDATE){
            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_edit_keyword', array(
                'id' => $keyword->getId()
            ));
            $renderOptions['form_title'] = "Mettre à jour le mot-clé";
        }

        return $this->render('@ESGISGabonPost/Backend/keywords.html.twig', $renderOptions);
    }

    protected function doDeleteKeyword(Keyword $keyword, ObjectManager $manager)
    {
        $manager->remove($keyword);
    }

    protected function doDeleteCategory(Category $category, ObjectManager $manager){
        $manager->remove($category);
    }

    protected function AddOrEditCategory(Category $category, $pageTitle, $actionType = CRUD::CREATE)
    {
        $categoryId = $actionType === CRUD::UPDATE ? $category->getId() : 0;

        $form = $this->createForm(new CategoryType($categoryId), $category);

        $request = $this->get('request');

        if('POST' == $request->getMethod()){

            $form->handleRequest($request);

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $categoryManager = $this->get('blu_es_post.category_manager');

                // persis and flush the new or updated category
                $em->persist($category);
                $em->flush();

                if($request->isXmlHttpRequest()){
                    return new JsonResponse(array(
                        'result' => 'success',
                        'message' => $categoryManager->generateSuccessMessage($category, $actionType)
                    ));
                }

                $this->get('session')
                    ->getFlashBag()
                        ->add('success_info', $categoryManager->generateSuccessMessage($category, $actionType));

                $this->redirect($this->generateUrl('esgis_gabon_admin_categories'));
            }
            if($request->isXmlHttpRequest()){
                return new JsonResponse(array(
                    'result' => 'error',
                    'message' => $form->getErrorsAsString()
                ));
            }
        }

        $renderOptions = array(
            'page_title' => $pageTitle,
            'form' => $form->createView(),
            'action_type' => $actionType
        );

        if($actionType === CRUD::CREATE){

            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_categories');
            $renderOptions['form_title'] = "Ajouter une nouvelle catégorie";

        } else if($actionType === CRUD::UPDATE){
            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_edit_category', array(
                'id' => $category->getId()
            ));
            $renderOptions['form_title'] = "Mettre à jour la catégorie";
        }


        return $this->render('@ESGISGabonPost/Backend/categories.html.twig', $renderOptions);
    }

    protected function AddOrEditPost(CorporatePost $corporatePost, $pageTitle, $actionType = CRUD::CREATE)
    {

        $form = $this->createForm(new CorporatePostType($this->get('doctrine.orm.entity_manager')), $corporatePost);

        $request = $this->get('request');
        if($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $tagManager = $this->get('blu_es_post.tag_manager');
                $postManager = $this->get('blu_es_post.post_manager');

                // persist and flush the new post
                $em->persist($corporatePost);
                $em->flush();

                // after flushing the post, tell the tag manager to actually save the tags
                $tagManager->saveTagging($corporatePost);

                $this
                    ->get('session')
                        ->getFlashBag()
                            ->add('success_info', $postManager->generateSuccessMessage($corporatePost, $actionType));

                if(CRUD::CREATE === $actionType)
                    $this->redirect($this->generateUrl('esgis_gabon_admin_edit_post', array(
                        'id' => $corporatePost->getId()
                    )));
            }
        }

        $renderOptions = array(
            'page_title' => $pageTitle,
            'form' => $form->createView()
        );

        if($actionType === CRUD::CREATE)
            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_add_post');
        else if($actionType === CRUD::UPDATE)
            $renderOptions['action_url'] = $this->generateUrl('esgis_gabon_admin_edit_post', array(
                'id' => $corporatePost->getId()
            ));

        return $this->render('ESGISGabonPostBundle:Backend:addpost.html.twig', $renderOptions);
    }

}
