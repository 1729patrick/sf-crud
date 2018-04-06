<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProdutoController extends Controller {
    /**
     * @Route("/produto", name="listar_produto")
     */
    public function index() {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em ->getRepository(Produto::class) ->findAll();

        return $this->render("produto/index.html.twig", [
            'produtos' => $produtos
        ]);
    }




    /**
     * @param Request $request
     *
     * @Route("produto/cadastrar", name="cadastrar_produto")
     *
     * @Template("produto/create.html.twig")
     */
    public function create(Request $request) {

        $produto = new Produto();

        $form = $this-> createForm(ProdutoType::class, $produto);

        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($produto);
            $em->flush();

//            $this->get('session')->getFlashBag()->set('success', 'Produto ' . $produto->getNome() .' foi salvo com sucesso.');

            $this->addFlash('success', 'Produto ' . $produto->getNome() .' salvo com sucesso.');
	        return $this->redirectToRoute('listar_produto');

        }

        return [
            'form' => $form->createView()
        ];
    }




    /**
     * @param Request $request
     *
     * @Route("produto/editar/{id}", name="editar_produto")
     *
     * @Template("produto/update.html.twig")
     */
    public function update(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository(Produto::class)->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);
        $form ->handleRequest($request);


	    if ($form->isSubmitted() && $form->isValid()) {
		    $em = $this->getDoctrine()->getManager();

		    $em->persist($produto);
		    $em->flush();

		    $this->get('session')->getFlashBag()->set('success', 'Produto ' . $produto->getNome() . ' atualizado com sucesso.');
		    return $this->redirectToRoute('listar_produto');

	    }

        return [
            'produto' => $produto,
	        'form' => $form->createView()
        ];
    }


	/**
	 * @param Request $request
	 *
	 * @return Response
	 *
	 * @Route("produto/visualizar/{id}", name="visualizar_produto")
	 *
	 * @Template("produto/view.html.twig")
	 */
    public function view(Request $request, $id) {

    	$em = $this->getDoctrine()->getManager();

    	$produto = $em->getRepository(Produto::class)->find($id);


    	return [
    		'produto' => $produto
	    ];
    }


	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @Route("produto/apagar/{id}", name="apagar_produto")
	 */
    public function  delete(Request $request, $id) {

    	$em = $this->getDoctrine()->getManager();
    	$produto = $em ->getRepository(Produto::class)->find($id);

    	if (!$produto){
    		$mensagem = "Produto não encontrado!";
    		$tipo = "warning";
	    }else {
    		$em->remove($produto);
    		$em->flush();
    		$mensagem = "Produto foi excluido com sucesso!";
		    $tipo = "warning";
	    }

		      $this->get('session')->getFlashBag()->set($tipo, $mensagem);
    	       return $this->redirectToRoute('listar_produto');
    }

}
