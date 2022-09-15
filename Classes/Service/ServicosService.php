<?php

namespace Service;

use Util\ConstantesGenericasUtil;
use Repository\ServicosRepository;

class ServicosService
{

    public function get($codigo = null){
        return $codigo ? $this->getOneByKey($codigo) : $this->getAll();
    }

    public function post($dados){
        $retorno = [];
        $this->ServicoRepository = new ServicosRepository();
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->ServicoRepository->insert($dados);
        return $retorno;
    }

    public function put($dados, $codigo){
        $retorno = [];
        $this->ServicoRepository = new ServicosRepository();
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->ServicoRepository->update($dados, $codigo);
        return $retorno;
    }

    public function delete($codigo){
        $retorno = [];
        $this->ServicoRepository = new ServicosRepository();
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->ServicoRepository->delete($codigo);
        return $retorno;
    }

    private function getAll(){
        $this->ServicoRepository = new ServicosRepository();
        $page = null;
        $countpage = null;
        $order = null;
        $filter = null;
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['countpage']) && !empty($_GET['countpage'])){
            $countpage = $_GET['countpage'];
        }
        if(isset($_GET['order']) && !empty($_GET['order'])){
            $order= $_GET['order'];
        }
        if(isset($_GET['filter']) && !empty($_GET['filter'])){
            $filter = $_GET['filter'];
        }
        $retorno[ConstantesGenericasUtil::DATA] = $this->ServicoRepository->getFilter($page, $countpage, $order, $filter);
        $retorno[ConstantesGenericasUtil::COUNT] = $this->ServicoRepository->count()[0]['qtde'];
        return $retorno;
    }

    private function getOneByKey($codigo){
        $this->ServicoRepository = new ServicosRepository();
        $retorno[ConstantesGenericasUtil::DATA] = $this->ServicoRepository->getOneByKey($codigo);
        return $retorno;
    }

}