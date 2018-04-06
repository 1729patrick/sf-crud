<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdutoRepository")
 */
class Produto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=100)
     *  @Assert\NotBlank(message="Campo Preço do Produto não pode ser vazio.")
     *
     */
    private $nome;

	/**
	 * @return string
	 */
	public function getNome()
	{
		return $this->nome;
	}

	/**
	 * @param string $nome
	 * @return Produto
	 */
	public function setNome(string $nome): Produto
	{
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getPreco()
	{
		return $this->preco;
	}

	/**
	 * @param float $preco
	 * @return Produto
	 */
	public function setPreco(float $preco): Produto
	{
		$this->preco = $preco;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * @param string $descricao
	 * @return Produto
	 */
	public function setDescricao(string $descricao): Produto
	{
		$this->descricao = $descricao;
		return $this;
	}


    /**
     * @var float
     *
     *  @ORM\Column(type="decimal", scale=2)
     *  @Assert\NotBlank(message="Campo Nome do Produto não pode ser vazio.")
     *
     */
    private $preco;


    /**
     * @var string
     *
     * @ORM\Column(type="text", length=100)
     *
     *  @Assert\NotBlank(message="Campo Descrição do produto não pode ser vazio.")
     */
    private $descricao;
}
