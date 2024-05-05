<?php 

require_once("Conexao.php");
require_once("Vendedor.php");


class VendedorDAO{
    public function create(Vendedor $vendedor){
        $sql = 'INSERT INTO vendedor($id,$nome,$email,$senha,$telefone,$cnpj,$endereco) values (?,?,?,?,?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $vendedor->getNome());
        $stmt->bindValue(2, $vendedor->getEmail());
        $stmt->bindValue(3, $vendedor->getSenha());
        $stmt->bindValue(4, $vendedor->getTelefone());
        $stmt->bindValue(5, $vendedor->getCnpj());
        $stmt->bindValue(6, $vendedor->getEndereco());
        $stmt->execute();
    }

    public function read(Vendedor $vendedor){
        $sql = 'SELECT * FROM vendedor';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function uptade(Vendedor $vendedor){
        $sql = 'UPTADE vendedor SET nome = ?, email = ?, senha = ?, telefone = ?, cnpj = ?, 
        endereco = ?
        where id = ? ';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $vendedor->getNome());
        $stmt->bindValue(2, $vendedor->getEmail());
        $stmt->bindValue(3, $vendedor->getSenha());
        $stmt->bindValue(4, $vendedor->getTelefone());
        $stmt->bindValue(5, $vendedor->getCnpj());
        $stmt->bindValue(6, $vendedor->getEndereco());
        $stmt->bindValue(7, $vendedor->getId());

        $stmt->execute();
    }

    public function delete(Vendedor $vendedor){
        $sql = "DELETE FROM vendedor WHERE id = ?";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $vendedor->getId());
        $stmt->execute();
    }

}







?>