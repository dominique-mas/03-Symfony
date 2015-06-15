<?php

namespace Dominique\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dominique\BlogBundle\Entity\Article;
use Dominique\BlogBundle\Entity\Image;
use Dominique\BlogBundle\Entity\Comment;
use Dominique\BlogBundle\Entity\Category;
use Dominique\BlogBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller {

    /**
     * 
     * @param type $page
     * @return type
     */
    public function indexAction() {
        $repository = $this->getDoctrine()->getManager()
                ->getRepository('DominiqueBlogBundle:Article');

        //$listeArticles = $repository->findAll();
        $listeArticles = $repository->getArticles();

        // Ici Blog est le chemin vers la vue.
        return $this->render('DominiqueBlogBundle:Blog:index.html.twig', array('listeArticles' => $listeArticles));
    }

    /**
     * 
     * @param type $id
     * @return type
     * Si les conventions sont respectées, le paramètre de atTemplate est optionnel.
     * @Template("DominiqueBlogBundle:Blog:see.html.twig")
     */
    public function seeAction($id) {

        $repArticle = $this->getDoctrine()->getManager()
                ->getRepository('DominiqueBlogBundle:Article');
        // On récupère l'article
        //$article = $repArticle->find($id);
        $article = $repArticle->getArticleById($id);
        $repComment = $this->getDoctrine()->getManager()
                ->getRepository('DominiqueBlogBundle:Comment');
        $listeComments = $repComment->findBy(array('article' => $article));
        // On pouvait aussi utiliser la méthode magique __call et finByX($valeur)
        // $listeComments = $repositoryComment->findByArticle($article);
        $repCategory = $this->getDoctrine()->getManager()
                ->getRepository('DominiqueBlogBundle:Category');

        //return $this->render('DominiqueBlogBundle:Blog:see.html.twig', 
        //array('article' => $article, 'listeComments' => $listeComments));
        //@Template permet de simplifier la ligne de retour.
        return array('article' => $article, 'listeComments' => $listeComments);
    }

    public function addAction() {
        // Création de l'article
        $article = new Article;

        // Ancienne méthode
        // Création du FormBuilder
        /* $formBuilder = $this->createFormBuilder($article);

          // On ajoute les champs de l'entité que l'on veut à notre formulaire
          $formBuilder
          ->add('dateCreat',  'date')
          ->add('title',      'text')
          ->add('content',     'textarea')
          ->add('author',      'text')
          ->add('pub',         'checkbox');

          $form = $formBuilder->getForm(); */

        // Nouvelle méthode
        $form = $this->createForm(new ArticleType, $article);

        $request = $this->getRequest();

        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);

            if ($form->isValid()) {
                try {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($article);
                    $entityManager->flush();
                } catch (Exception $ex) {
                    
                }
            }
        }

        // Temp : ajout "en dur" des données
        /* $article->setTitle('Tsonga : la déception de Roland Garros')
          ->setAuthor('Arthur')
          ->setContent('Tsonga avait porté beaucoup d\'espoir
          en 2015 mais ... ...');
          // Création de l'image
          $image = new Image;
          $image->setUrl('Tsonga.jpg')->setAlt('Tsonga');
          $article->setImage($image);
          // Création du commentaire n°1
          $comment1 = new Comment;
          $comment1->setArticle($article)->setAuthor('Domi')
          ->setContent('Moi le tennis, je m\'en fous de toute façon !');
          // Création du commentaire n°2
          $comment2 = new Comment;
          $comment2->setArticle($article)->setAuthor('Jack')
          ->setContent('Franchement, je préfère le foot.');
          // Catégories
          $category1 = new Category;
          $category1->setName('Sport');
          $category2 = new Category;
          $category2->setName('Actualités');
          $article->addCategory($category1)->addCategory($category2);

          $em = $this->getDoctrine()->getManager();
          // On persiste l'article. Avec cascade/persist,
          // l'image est persistée aussi.
          $em->persist($article);
          // On persiste les commentaires.
          $em->persist($comment1);
          $em->persist($comment2);
          // On persiste les catégories.
          $em->persist($category1);
          $em->persist($category2);

          $em->flush();

          return $this->redirect($this->generateUrl('dominique_blog_see',
          array('id' => $article->getId()))); */

        return $this->render('DominiqueBlogBundle:Blog:add.html.twig', array('form' => $form->createView()));
    }

    public function modifyAction($id) {
        
    }

}
