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
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{
    private function getUserId(){
      $userId = $this->get('security.token_storage')->getToken()->getUser();
      if ($userId == 'anon.')
        $userId = '';
      else
        $userId = $userId->getId();

      return $userId;
    }

    private function display_home($message = '')
    {
      $urlIndex = $this->container->get('router')->generate('index');
      $urlArticles = $this->container->get('router')->generate('articles');
      $urlCategories = $this->container->get('router')->generate('categories');
      $urlRegistration = $this->container->get('router')->generate('register');
      $urlLogin = $this->container->get('router')->generate('login');
      $urlLogout = $this->container->get('router')->generate('logout');

      return $this->render('lcb/index.html.php', array('message' => $message, 'userId' => $this->getUserId(), 'urlIndex' => $urlIndex, 'urlArticles' => $urlArticles, 'urlCategories' => $urlCategories, 'urlRegistration' => $urlRegistration, 'urlLogin' => $urlLogin, 'urlLogout' => $urlLogout));
    }

    /**
     * @Route("/index", name="index")
     */
    public function indexAction()
    {
      return $this->display_home();
    }

    /**
     * @Route("/create_user", name="create_user")
     */
    public function createAction(Request $request)
    {
        $user = new Users;
        $name = $request->request->get('tbName');//$_POST['tbName'];
        $pass = $request->request->get('tbPass');//$_POST['tbPass'];

        $user->setName($name);
        $user->setPass($pass);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->display_home();
    }

    /**
     * @Route("/login_user", name="login_user")
     */
    public function login_userAction()
    {
        $name = $_POST['tbName'];
        $pass = $_POST['tbPass'];

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $users = $qb->select(array('t'))
        ->from('AppBundle:Users', 't')
        ->where("t.name = '".$name."'")
        ->andWhere("t.pass = '".$pass."'")
        ->getQuery()
        ->getResult();

        if(count($users) > 0) {
          $this->get('session')->set('userId', $users[0]->getId());
        }

        return $this->display_home();
    }

    /**
     * @Route("/logout_user", name="logout_user")
     */
    public function logout_userAction()
    {
        $this->get('session')->remove('userId');
        return $this->display_home();
    }

}
