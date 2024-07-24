<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request): Response
    {
        $result = null;

        if ($request->isMethod('POST')) {
            $number1 = $request->request->get('number1');
            $number2 = $request->request->get('number2');
            $operation = $request->request->get('operation');

            if (is_numeric($number1) && is_numeric($number2)) {
                switch ($operation) {
                    case 'add':
                        $result = $number1 + $number2;
                        break;
                    case 'subtract':
                        $result = $number1 - $number2;
                        break;
                    case 'multiply':
                        $result = $number1 * $number2;
                        break;
                    case 'divide':
                        if ($number2 != 0) {
                            $result = $number1 / $number2;
                        } else {
                            $result = 'Cannot divide by zero';
                        }
                        break;
                    default:
                        $result = 'Invalid operation';
                }
            } else {
                $result = 'Invalid input';
            }
        }

        return $this->render('calculator/index.html.twig', [
            'result' => $result,
        ]);
    }
}
