<?php


namespace Model;

/**
 * @Entity(repositoryClass="Repository\PessoaRepository")
 * @Table(name="pessoas")
 */
class Pessoa
{
    /**
     * @Id
     * @Column(name="usu_id", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(name="pes_nome", type="string")
     */
    protected $nome;

    /**
     * @Column(name="pes_sobrenome", type="string")
     */
    protected $sobrenome;

    /**
     * @Column(name="pes_cpf_cnpj", type="string")
     */
    protected $cpfCnpj;




}