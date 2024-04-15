<?php


class fornecedor {

    private $id_forn = 0;
    private $razao_social= null;
    private $cnpj= null;
    private $end_forn= null;
    private $tel_forn= null;

    public function setId(int $id_forn) :void
    {
        $this->id = $id_forn;
    }

    public function getId() :int
    {
        return $this->id;
    }

    public function setrazao(string $razao_social) :void
    {
        $this->razao = $razao_social;
    }

    public function getrazao() :string
    {
        return $this->razao;
    }

    public function setcnpj(string $cnpj) :void
    {
        $this->cnpj = $cnpj;
    }

    public function getcnpj() :string
    {
        return $this->cnpj;
    }


    public function setend(string $end_forn) :void
    {
        $this->end = $end_forn;
    }

    public function getend() :string
    {
        return $this->end;
    }

    public function settel(string $tel_forn) :void
    {
        $this->tel = $tel_forn;
    }

    public function gettel() :string
    {
        return $this->tel;
    }

    private function connection() :\PDO
    {
        return new \PDO("mysql:host=localhost;dbname=gelagoela","root","");
    }

    public function create() 
    {
        $connect = $this->connection();
        $stmt= $connect->prepare("INSERT INTO fornecedor VALUES (NULL,:_razao,:_cnpj,:_end,:_tel)");
        $stmt->bindValue(":_razao", $this->getrazao(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_cnpj", $this->getcnpj(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_end", $this->getend(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_tel", $this->gettel(), \PDO::PARAM_STR); //Parametro para aceitar só string

        if($stmt->execute()){
            $this->setId($connect->lastInsertId());
            return $this->read();
        }
    }

    public function read() :array
    {
        $connect = $this->connection();
        if($this->getId()===0){
            $stmt= $connect->prepare("SELECT * FROM fornecedor");
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC); //Parametro associativo para retornar Chave / valor
        }
    }   else if($this->getId() > 0){
            $stmt= $connect->prepare("SELECT * FROM fornecedor WHERE id_fornecedor = :_id");
            $stmt-> bindValue(":_id", $this->getId(),\PDO::PARAM_INT );
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC); //Parametro associativo para retornar Chave / valor
            }
            
        }
        return [];
       
    }

    public function update() :array
    {
        $connect = $this->connection();
        $stmt= $connect->prepare("UPDATE fornecedor SET razao_social = :_razao, cnpj = :_cnpj, endereco =:_end, telefone= :_tel  WHERE id_fornecedor=:_id");
        $stmt->bindValue(":_razao", $this->getrazao(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_cnpj", $this->getcnpj(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_end", $this->getend(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_tel", $this->gettel(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt-> bindValue(":_id", $this->getId(),\PDO::PARAM_INT );

        if($stmt->execute()){
            return $this->read();
        }
        return [];
    }

    public function delete() :array
    {
        $fornecedor = $this->read();
        $connect = $this->connection();
        $stmt= $connect->prepare("DELETE FROM fornecedor WHERE id_fornecedor= :_id");
        $stmt-> bindValue(":_id", $this->getId(),\PDO::PARAM_INT );

        if($stmt->execute()){
            return $fornecedor;
        }
        return [];
    }


}
