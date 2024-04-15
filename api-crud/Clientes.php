<?php


class clientes {

    private $id_cliente = 0;
    private $nome_cliente= null;
    private $cpf= null;
    private $email_cliente= null;
    private $end_cliente= null;
    private $tel_cliente= null;

    public function setId(int $id_cliente) :void
    {
        $this->id = $id_cliente;
    }

    public function getId() :int
    {
        return $this->id;
    }

    public function setName(string $nome_cliente) :void
    {
        $this->name = $nome_cliente;
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function setcpf(string $cpf) :void
    {
        $this->cpf = $cpf;
    }

    public function getcpf() :string
    {
        return $this->cpf;
    }

    public function setemail(string $email_cliente) :void
    {
        $this->email = $email_cliente;
    }

    public function getemail() :string
    {
        return $this->email;
    }

    public function setend(string $end_cliente) :void
    {
        $this->end = $end_cliente;
    }

    public function getend() :string
    {
        return $this->end;
    }

    public function settel(string $tel_cliente) :void
    {
        $this->tel = $tel_cliente;
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
        $stmt= $connect->prepare("INSERT INTO clientes VALUES (NULL,:_nome,:_cpf,:_email,:_end,:_tel)");
        $stmt->bindValue(":_nome", $this->getName(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_cpf", $this->getcpf(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_email", $this->getemail(), \PDO::PARAM_STR); //Parametro para aceitar só string
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
            $stmt= $connect->prepare("SELECT * FROM clientes");
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC); //Parametro associativo para retornar Chave / valor
        }
    }   else if($this->getId() > 0){
            $stmt= $connect->prepare("SELECT * FROM clientes WHERE id_cliente = :_id");
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
        $stmt= $connect->prepare("UPDATE clientes SET nome_cliente = :_nome, cpf = :_cpf, email_cliente = :_email, endereco_cliente =:_end, telefone_cliente= :_tel  WHERE id_cliente=:_id");
        $stmt->bindValue(":_nome", $this->getName(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_cpf", $this->getcpf(), \PDO::PARAM_STR); //Parametro para aceitar só string
        $stmt->bindValue(":_email", $this->getemail(), \PDO::PARAM_STR); //Parametro para aceitar só string
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
        $Clientes = $this->read();
        $connect = $this->connection();
        $stmt= $connect->prepare("DELETE FROM clientes WHERE id_cliente= :_id");
        $stmt-> bindValue(":_id", $this->getId(),\PDO::PARAM_INT );

        if($stmt->execute()){
            return $Clientes;
        }
        return [];
    }


}
