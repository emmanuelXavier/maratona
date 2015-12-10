<?php

class Maratona{

	private $id;
	private $datainicio;
	private $nome;
	private $datafim;
	private $juiz;

	public function getId()
	{
	    return $this->id;
	}

	public function getDatainicio()
	{
	    return $this->datainicio;
	}
	
	public function setDatainicio($datainicio)
	{
	    $this->datainicio = $datainicio;
	}

	public function getNome()
	{
	    return $this->nome;
	}
	
	public function setNome($nome)
	{
	    $this->nome = $nome;
	}

	public function getDatafim()
	{
	    return $this->datafim;
	}
	
	public function setDatafim($datafim)
	{
	    $this->datafim = $datafim;
	}

	public function getJuiz()
	{
	    return $this->juiz;
	}
	
	public function setJuiz($juiz)
	{
	    $this->juiz = $juiz;
	}

	public function salvar($con){
		$sql = "insert into maratona (datainicio,nome,datafim,juiz) values ('$this->getDatainicio()','$this->getNome()','$this->getDatafim','$this->juiz')";
		$res = mysqli_query($con,$sql);
		if ($res)
			return true;
		else
			return false;

	}
	

}
