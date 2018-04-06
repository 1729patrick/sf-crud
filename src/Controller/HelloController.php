<?php
/**
 * Created by PhpStorm.
 * User: dev05
 * Date: 05/04/18
 * Time: 16:06
 */


namespace App\Controller;


use App\Entity\Produto;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; //para definir a rota dessa página http://localhost:8000/hello-world


class HelloController extends Controller{
    /**
     * @return Response
     *
     * @Route("hello-world") para definir a rota dessa página http://localhost:8000/hello-world
     */
    public function world(){

        return new Response(
            "<html><body><h1>Hello World!</h1></body></html>"
        );
    }


    /**
     * @return Response
     *
     * @Route("mostrar-mensagem")
     */
    public function  mensagem(){

        return $this->render("hello/mensagem.html.twig", [
            'mensagem' => 'Exemplo de mensagem.'
        ]);
    }

    /**
     * @return Response
     *
     * @Route("cadastrar-produto")
     */
    public function produto(){
        $em = $this->getDoctrine()->getManager();

        $produto = new Produto();
        $produto->setNome("Macbook Pro")
                ->setPreco(12.000);

                $em->persist($produto);
                $em->flush();

                return new Response("O produto " . $produto->getId() . " foi criado.");
    }


    /**
     * @return Response
     *
     * @Route("formulario")
     *
     */
    public function  formulario(Request $request){

        $produto = new Produto();

        $form  = $this->createFormBuilder($produto)
            ->add('nome', TextType::class)
            ->add('preco', TextType::class)
            ->add('enviar', SubmitType::class, ['label' => 'Salvar'])
            ->getForm();


        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            return new Response("Formulário está ok.");
        }

        return $this->render("hello/formulario.html.twig", [
            'form' => $form->createView()
            ]);
    }
}