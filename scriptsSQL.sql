
 The following SQL statements will be executed:

     DROP INDEX "primary";
     ALTER TABLE pessoas ADD pes_data_nascimento DATE NOT NULL;
     ALTER TABLE pessoas RENAME COLUMN usu_id TO pes_id;
     ALTER TABLE pessoas RENAME COLUMN pes_cpf_cnpj TO pes_cpf;
     ALTER TABLE pessoas ADD PRIMARY KEY (pes_id);
     ALTER TABLE usuarios ADD pes_id INT NOT NULL;
     ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F2BB8470F FOREIGN KEY (pes_id) REFERENCES pessoas (pes_id) NOT DEFERRABLE INITIALLY IMMEDIATE;
     CREATE INDEX IDX_EF687F2BB8470F ON usuarios (pes_id);
