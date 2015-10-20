<?php

namespace ESGISGabon\PostBundle\Controller;

use FOS\RestBundle\View\View;
use Hateoas\Configuration\Route;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Hateoas\Representation\CollectionRepresentation;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostRestController extends Controller
{
    /**
     * @QueryParam(name="page", requirements="\d+", default="1", description="Page of the overview")
     * @QueryParam(name="limit", requirements="\d+", default="10", description="Size of the page")
     * @QueryParam(name="sort", requirements="[a-z]+", description="Sort parameter")
     * @QueryParam(name="sort_order", requirements="(asc|desc)", allowBlank=false, default="asc", description="Sort direction")
     * @QueryParam(name="search", requirements="[a-zA-Z0-9]+", description="Search")
     * @QueryParam(name="status", requirements="(pending|publish|draft|auto-draft|future|private|inherit|trash)",  default="", nullable=true, description="Status of the posts")
     * @QueryParam(name="by_author", requirements="[a-zA-Z]+", description="By author's username", incompatibles={"search"})
     * @QueryParam(name="by_category", requirements="[a-zA-Z]+", description="By category", incompatibles={"search"})
     * @QueryParam(name="by_keywords", requirements="[a-zA-Z]+", description="By keywords", incompatibles={"search"})
     * @QueryParam(name="format", requirements="[a-z]+", default="lite", description="Format of request")
     * @Rest\View()
     */
    public function getPostsAction(ParamFetcher $paramFetcher)
    {
        $page = $paramFetcher->get("page");
        $limit = $paramFetcher->get("limit");
        $sort = $paramFetcher->get("sort");
        $sort_order = $paramFetcher->get("sort_order");
        $search = $paramFetcher->get("search");
        $status = $paramFetcher->get("status");
        $by_author = $paramFetcher->get("by_author");
        $by_category = $paramFetcher->get("by_category");
        $by_keywords = $paramFetcher->get("by_keywords");
        $format = $paramFetcher->get("format");

        $repo = $this->getDoctrine()->getManager()->getRepository('ESGISGabonPostBundle:CorporatePost');

        $posts = $repo->getPosts($format);

        $adapter = new ArrayAdapter($posts);
        $pager = new Pagerfanta($adapter);

        $pager->setMaxPerPage($limit);

        try {
            $pager->setCurrentPage($page);
        } catch(NotValidCurrentPageException $e){
            throw new NotFoundHttpException();
        }

        $pagerfantaFactory = new PagerfantaFactory();
        $paginatedCollection = $pagerfantaFactory->createRepresentation(
            $pager,
            new Route('api_get_posts', array(
                'page' => $page,
                'limit' => $limit,
                'sort' => $sort,
                'sort_order' => $sort_order
            )),
            new CollectionRepresentation(
                $pager->getCurrentPageResults(),
                'posts',
                'posts'
            )
        );

        return $paginatedCollection;
    }

    public function postPostsAction()
    {
        
    }

    public function getPostAction($slug)
    {
        return new JsonResponse(array(
            'slug' => $slug
        ));
    }

    public function putPostAction($slug)
    {
        return new JsonResponse(array(
            'slug' => $slug
        ));
    }

    public function trashPostAction($slug)
    {
        return new JsonResponse(array(
            'slug' => $slug
        ));
    }
}
