<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
//        return parent::index();
      // you can also render some template to display a proper Dashboard
      // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
      return $this->render('admin/dashboard-welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Conference Guestbook');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Conference');
        yield MenuItem::linkToCrud('Conferences', 'fas fa-calendar-week', Conference::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);

        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
