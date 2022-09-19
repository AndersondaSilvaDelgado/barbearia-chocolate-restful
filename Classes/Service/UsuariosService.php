<?php

namespace Service;

use Util\ConstantesGenericasUtil;
use Repository\UsuariosRepository;

class UsuariosService
{

    public function get($codigo = null){
        return $codigo ? $this->getOneByKey($codigo) : $this->getAll();
    }

    public function post($dados){
        $retorno = [];
        $this->UsuariosRepository = new UsuariosRepository();
        unset($dados['id']);
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->UsuariosRepository->insert($dados);
        return $retorno;
    }

    public function put($dados, $codigo){
        $retorno = [];
        $this->UsuariosRepository = new UsuariosRepository();
        unset($dados['id']);
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->UsuariosRepository->update($dados, $codigo);
        return $retorno;
    }

    public function login($dados){
        $retorno = [];
        $this->UsuariosRepository = new UsuariosRepository();
        unset($dados['id']);
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->UsuariosRepository->login($dados);
        return $retorno;
    }

    public function delete($codigo){
        $retorno = [];
        $this->UsuariosRepository = new UsuariosRepository();
        $retorno[ConstantesGenericasUtil::RESPONSE] = $this->UsuariosRepository->delete($codigo);
        return $retorno;
    }

    private function getAll(){
        $this->UsuariosRepository = new UsuariosRepository();
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
        $retorno[ConstantesGenericasUtil::DATA] = $this->UsuariosRepository->getFilter($page, $countpage, $order, $filter);
        $retorno[ConstantesGenericasUtil::COUNT] = $this->UsuariosRepository->count()[0]['qtde'];
        return $retorno;
    }

    private function getOneByKey($codigo){
        $this->UsuariosRepository = new UsuariosRepository();
        $retorno[ConstantesGenericasUtil::DATA] = $this->UsuariosRepository->getOneByKey($codigo);
        return $retorno;
    }

}