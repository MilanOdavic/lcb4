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

class CategorieController extends Controller
{
    private function getUserId(){
      $userId = $this->get('security.token_storage')->getToken()->getUser();
      if ($userId == 'anon.')
        $userId = '';
      else
        $userId = $userId->getId();

      return $userId;
    }

    private function display_categories($message = '')
    {
      $categories = $this->getDoctrine()
          ->getRepository('AppBundle:Categories')
          ->findAll();

      $urlIndex = $this->container->get('router')->generate('index');
      $urlArticles = $this->container->get('router')->generate('articles');
      $urlCategories = $this->container->get('router')->generate('categories');

      return $this->render('lcb/categorie.html.php', array('message' => $message, 'categories' => $categories, 'userId' => $this->getUserId(), 'urlIndex' => $urlIndex, 'urlArticles' => $urlArticles, 'urlCategories' => $urlCategories));
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesAction($message='')
    {
      return $this->display_categories();
    }

    /**
     * @Route("/create_categorie", name="create_categorie")
     * @Security("has_role('ROLE_USER')")
     */
    public function create_categorieAction()
    {
        $categorie = new Categories;
        $title = $_POST['tbTitle'];

        $categorie->setTitle($title);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());
        $categorie->setUsersId($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        return $this->display_categories('Categorie is created.');
    }

    /**
     * @Route("/update_categorie", name="update_categorie")
     * @Security("has_role('ROLE_USER')")
     */
    public function update_categorieAction()
    {
        $categorieId = $_POST['categorieId'];
        $title = $_POST['tbTitle'];

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categorieId);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($this->getUserId());

        $categorie->setTitle($title);
        $categorie->setUsersId($user);

        $em->flush();

        return $this->display_categories('Categorie is updated.');
    }

    /**
     * @Route("/delete_categorie", name="delete_categorie")
     * @Security("has_role('ROLE_USER')")
     */
    public function delete_categorieAction()
    {
        $categorieId = $_POST['categorieId'];

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categorieId);

        $em->remove($categorie);
        $em->flush();

        return $this->display_categories('Categorie is deleted. With all its articles.');
    }

}
