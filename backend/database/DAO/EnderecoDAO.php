<?php 

require_once(__DIR__ . '/../conexao.php');
require_once(__DIR__ . '/../../classes/usuarios/endereco.php');


class EnderecoDAO{
    
    //Cadastra o Endereço (PK).
    public function create(Endereco $endereco){
        $sql = 'INSERT INTO endereco.endereco (logradouro, numero, bairro,	cep) values (?,?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $endereco->getLogradouro());
        $stmt->bindValue(2, $endereco->getNumero());
        $stmt->bindValue(3, $endereco->getBairro());
        $stmt->bindValue(4, $endereco->getBairro());
        $stmt->bindValue(5, $endereco->getCep());
        $stmt->execute();
    }

    //Cadastra o Municipio do Endereço (FK).
    public function create_mun(Endereco $endereco){
        $sql = 'INSERT INTO endereco.cidade (nome) values (?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $endereco->getNome_cidade());
        $stmt->execute();
    }

    //Cadastra o Estado do Municipio (FK).
    public function create_uf(Endereco $endereco){
        $sql = 'INSERT INTO endereco.estado (nome) values (?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $endereco->getNome_estado());
        $stmt->execute();
    }

    //Apresentação na aba de "Meus Endereços".
    public function read($id){
        $sql = "SELECT endereco.endereco.*
        FROM endereco.endereco 
        INNER JOIN usuario.cliente ON endereco.endereco.id_cliente = usuario.cliente.id
        WHERE usuario.cliente.id = ?";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(Endereco $endereco){
        $sql = "UPDATE endereco.endereco SET logradouro = ?, numero = ?, bairro = ?, cep = ?, id_cidadE = ?";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $endereco->getLogradouro());
        $stmt->bindValue(2, $endereco->getNumero());
        $stmt->bindValue(3, $endereco->getBairro());
        $stmt->bindValue(4, $endereco->getBairro());
        $stmt->bindValue(5, $endereco->getCep());
        $stmt->bindValue(6, $endereco->getId_cidade());
        $stmt->execute();
    }

    public function delete(Endereco $endereco){
        $sql = "DELETE FROM  endereco.endereco WHERE id_cliente = ?";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $endereco->getId());
        $stmt->execute();
    }
}

?>