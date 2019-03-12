<?php

namespace App\Controller;

use App\Math\Math;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArithmeticCalculatorController extends AbstractController
{
    /**
     * Define a route that can handle operations.
     * We'll generate a map of buttons.
     * @Route("/arithmetic/calculator", name="arithmetic_calculator")
     */
    public function index()
    {
        $numericalButtons = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $operatorButtons = ['+', '-', '/', '*'];

        return $this->render('arithmetic_calculator/index.html.twig',
          ['numbers' => $numericalButtons, 'operators' => $operatorButtons]);

    }

    /**
     * This will be an endpoint for an AJAX request.
     * We expect the request to contain a calculation string, the special operation is optional.
     * We expect the calculation string to mathematical statement that we would need to execute.
     * @Route("/arithmetic/calculator/submit", name="arithmetic_calculator_submit")
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function submitCalculation(Request $request)
    {
        $calculationString = str_replace(' ', ',',
          preg_replace('!\s+!', ' ', trim($request->get('calculationString'))));
        $result = $this->doMath($calculationString);
        return new JsonResponse($result);
    }

    /**
     * Square root a float value
     * @param float $number
     * @return float
     */
    protected function sqrt(float $number)
    {
        return sqrt($number);
    }

    /**
     * @param $calculationString
     * @return string
     * @throws \Exception
     */
    protected function doMath($calculationString)
    {
        $math = new Math();
        $explodedCalculationString = explode(',', $calculationString);
        $result = $math->evaluate(implode(' ', $explodedCalculationString));

        return $result;
    }
}
