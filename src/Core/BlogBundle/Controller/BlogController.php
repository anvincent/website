<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Core\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Blog controller.
 */
class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('CoreBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        $comments = $em->getRepository('CoreBlogBundle:Comment')
					   ->getCommentsForBlog($blog->getId());

        return $this->render('CoreBlogBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
			'comments'  => $comments
        ));
    }
}