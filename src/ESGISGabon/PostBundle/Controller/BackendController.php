<?php

namespace ESGISGabon\PostBundle\Controller;

use ESGISGabon\PostBundle\Entity\CorporatePost;
use ESGISGabon\PostBundle\Entity\Keyword;
use ESGISGabon\PostBundle\Form\CorporatePostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        $form = $this->createForm(new CorporatePostType(), $corporate_post);

        $request = $this->get('request');
        if($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $tagManager = $this->get('blu_es_post.tag_manager');

                //return new Response(print_r($corporate_post));

                // persist and flush the new post
                $em->persist($corporate_post);
                $em->flush();

                // after flushing the post, tell the tag manager to actually save the tags
                $tagManager->saveTagging($corporate_post);
            }
        }

        return $this->render('ESGISGabonPostBundle:Backend:addpost.html.twig',array(
            'page_title' => 'Ajouter un nouvel article',
            'form' => $form->createView()
        ));
    }

    public function editPostAction(CorporatePost $post)
    {
        return new Response("edit post");
    }

    public function removePostAction(CorporatePost $post)
    {
        return new Response("remove post");
    }

    public function showPostAction(CorporatePost $post)
    {
        return new Response("show post");
    }

    private function validForm($form)
    {

    }

}
