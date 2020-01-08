<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Articles;
use AppBundle\Entity\User;
use AppBundle\Entity\Categories;
use AppBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ArticleController extends Controller
{
    private function getUserId(){
      $userId = $this->get('security.token_storage')->getToken()->getUser();
      if ($userId == 'anon.')
        $userId = '';
      else
        $userId = $userId->getId();

      return $userId;
    }

    private function display_articles($message = '')
    {
      $articles = $this->getDoctrine()
          ->getRepository('AppBundle:Articles')
          ->findAll();

      $comments = $this->getDoctrine()
          ->getRepository('AppBundle:Comments')
          ->findAll();

      $urlIndex = $this->container->get('router')->generate('index');
      $urlArticles = $this->container->get('router')->generate('articles');
      $urlCategories = $this->container->get('router')->generate('categories');

      return $this->render('lcb/article.html.php', array('message' => $message, 'articles' => $articles, 'comments' => $comments, 'userId' => $this->getUserId(), 'urlIndex' => $urlIndex, 'urlArticles' => $urlArticles, 'urlCategories' => $urlCategories));
    }

    /**
     * @Route("/articles", name="articles")
     */
    public function articlesAction()
    {
        return $this->display_articles();
    }

    /**
     * @Route("/create_article", name="create_article")
     * @Security("has_role('ROLE_USER')")
     */
    public function create_articleAction()
    {
        $article = new Articles;
        $categoriesId = $_POST['tbCategoriesId'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categoriesId);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());

        $article->setCategoriesId($categorie);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsersId($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->display_articles("Article is created.");
    }

    // 5
    /**
     * @Route("/update_article", name="update_article")
     * @Security("has_role('ROLE_USER')")
     */
    public function update_articleAction()
    {
        $idArticles = $_POST['articleId'];
        $categoriesId = $_POST['tbCategoriesId'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($idArticles);
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categoriesId);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());

        $article->setCategoriesId($categorie);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsersId($user);

        $em->flush();

        return $this->display_articles("Article is updated.");
    }

    /**
     * @Route("/create_comment", name="create_comment")
     * @Security("has_role('ROLE_USER')")
     */
    public function create_commentAction()
    {
        $comment = new Comments;
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $articleId = $_POST['articleId'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($articleId);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticlesId($article);
        $comment->setUsersId($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->display_articles("Comment is created.");
    }

    /**
     * @Route("/update_comment", name="update_comment")
     * @Security("has_role('ROLE_USER')")
     */
    public function update_commentAction()
    {
        $idComment = $_POST['commentId'];
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $articleId = $_POST['articleId'];

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($idComment);
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($articleId);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticlesId($article);
        $comment->setUsersId($user);

        $em->flush();

        return $this->display_articles("Comment is updated.");
    }

    /**
     * @Route("/delete_article", name="delete_article")
     * @Security("has_role('ROLE_USER')")
     */
    public function delete_articleAction()
    {
        $articleId = $_POST['articleId'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($articleId);

        $em->remove($article);
        $em->flush();

        return $this->display_articles("Article is deleted.");
    }

    /**
     * @Route("/delete_comment", name="delete_comment")
     * @Security("has_role('ROLE_USER')")
     */
    public function delete_commentAction()
    {
        $commentId = $_POST['commentId'];

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($commentId);

        $em->remove($comment);
        $em->flush();

        return $this->display_articles("Comment is deleted.");
    }

}
