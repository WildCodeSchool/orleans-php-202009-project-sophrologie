<?php

namespace App\Controller;

use App\Entity\Report;
use App\Entity\SearchAdminReports;
use App\Entity\User;
use App\Form\ReportType;
use App\Form\SearchAdminReportsType;
use App\Repository\ReportRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReportController extends AbstractController
{
    /**
     * @Route("/admin/rapport", name="admin_reports")
     * @param Request $request
     * @param ReportRepository $reportRepository
     * @return Response|null
     */
    public function index(Request $request, ReportRepository $reportRepository): ?Response
    {
        $report = new Report();
        $formReport = $this->createForm(ReportType::class, $report);
        $formReport->handleRequest($request);

        if ($formReport->isSubmitted() && $formReport->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var User $user */
            $user = $this->getUser();
            $report->setAuthor($user);

            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('admin_home');
        }

        $searchReports = new SearchAdminReports();
        $filterSearchReports = $this->createForm(SearchAdminReportsType::class, $searchReports);
        $filterSearchReports->handleRequest($request);

        if ($filterSearchReports->isSubmitted() && $filterSearchReports->isValid()) {
            $reports = $reportRepository->findWithFilterUsers($searchReports);
        } else {
            $reports = $reportRepository->findBy([], ['id' => 'DESC']);
        }

        return $this->render('admin_report/index.html.twig', [
            'formReport' => $formReport->createView(),
            'filterReport' => $filterSearchReports->createView(),
            'reports' => $reports,
        ]);
    }

    /**
     * @Route("/admin/rapport/{id}/supprimer", name="admin_report_delete", methods={"DELETE"})
     * @param Request $request
     * @param Report $report
     * @return Response
     */
    public function delete(Request $request, Report $report): Response
    {
        if ($this->isCsrfTokenValid('delete' . $report->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($report);
            $entityManager->flush();

            $this->addFlash('success', 'Le rapport a bien été supprimé');
        }

        return $this->redirectToRoute('admin_reports');
    }
}
