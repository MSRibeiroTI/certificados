
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nacionalidade` varchar(45) NOT NULL,
  `naturalidade` varchar(45) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `rg` varchar(45) NOT NULL,
  `graduacao` varchar(55) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` VALUES (1,'João Samsung da China Paraguai Lotus','Brasileiro','Pedra - PE','José Nokia da Silva','Maria Motorola dos Santos','1995-04-04','154884/SSPPE','Licenciatura em Pedagogia'),(2,'Marcelo de Souza Ribeiro','Brasileiro','São Bernardo do Campo - SP','Cosme da Silva Ribeiro','Maria Marlene de Souza Ribeiro','1981-11-18','1355217695 - SSPBA','Graduado em Gestão Comercial'),(5,'Alex Silva do Nascimento','Brasileiro','Pedra-PE','Severino Silva do Nascimento','Lúcia Rodrigues Silva do Nascimento','1995-09-04','9.315.642-SDS/PE','Licenciatura em Pedagogia'),(6,'Pedro Igor da Silva Ribeiro','Brasileiro','Belo Jardim - PE','Marcelo de Souza Ribeiro','Fabiana Ferreira da Silva Ribeiro','2006-02-05','1667237039/SSPBA','Tecnólogo em Análise e Desenvolvimento de Sistemas'),(7,'Kalil Gabriel da Silva Ribeiro','Brasileiro','Brejo da Madre de Deus - PE','Marcelo de Souza Ribeiro','Fabiana Ferreira da Silva Ribeiro','2011-04-18','00001213 - SSPBA','Licenciatura em Pedagogia'),(8,'Teste','Brasileiro','Brejo da Madre de Deus - PE','teste','teste','2022-08-31','00001213 - SSPBA','Licenciatura em Pedagogia'),(9,'Raul da Silva','Brasileiro','Brejo da Madre de Deus - PE','Marcelo de Souza Ribeiro','Fabiana Ferreira da Silva Ribeiro','2021-08-31','00001213 - SSPBA','Licenciatura em Pedagogia');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cert_done`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cert_done` (
  `id_cert_done` int NOT NULL AUTO_INCREMENT,
  `curso` varchar(100) NOT NULL,
  `tipo_curso` varchar(55) NOT NULL,
  `c_hor_curso` int NOT NULL,
  `inicio_curso` date NOT NULL,
  `fim_curso` date NOT NULL,
  `data_certi` date NOT NULL,
  `diretor` varchar(100) NOT NULL,
  `ies` varchar(100) NOT NULL,
  `parecer` varchar(100) NOT NULL,
  `parece_curso` varchar(45) NOT NULL,
  `aluno` varchar(100) NOT NULL,
  `nacionalidade` varchar(45) NOT NULL,
  `naturalidade` varchar(45) NOT NULL,
  `pai` varchar(100) NOT NULL,
  `mae` varchar(100) NOT NULL,
  `nascimento` date NOT NULL,
  `rg` varchar(45) NOT NULL,
  `graduado` varchar(55) NOT NULL,
  `tcc` varchar(255) NOT NULL,
  `disc1` varchar(100) DEFAULT NULL,
  `disc2` varchar(100) DEFAULT NULL,
  `disc3` varchar(100) DEFAULT NULL,
  `disc4` varchar(100) DEFAULT NULL,
  `disc5` varchar(100) DEFAULT NULL,
  `disc6` varchar(100) DEFAULT NULL,
  `disc7` varchar(100) DEFAULT NULL,
  `disc8` varchar(100) DEFAULT NULL,
  `disc9` varchar(100) DEFAULT NULL,
  `disc10` varchar(100) DEFAULT NULL,
  `disc11` varchar(100) DEFAULT NULL,
  `disc12` varchar(100) DEFAULT NULL,
  `disc13` varchar(100) DEFAULT NULL,
  `disc14` varchar(100) DEFAULT NULL,
  `disc15` varchar(100) DEFAULT NULL,
  `disc16` varchar(100) DEFAULT NULL,
  `disc17` varchar(100) DEFAULT NULL,
  `ch1` int DEFAULT NULL,
  `ch2` int DEFAULT NULL,
  `ch3` int DEFAULT NULL,
  `ch4` int DEFAULT NULL,
  `ch5` int DEFAULT NULL,
  `ch6` int DEFAULT NULL,
  `ch7` int DEFAULT NULL,
  `ch8` int DEFAULT NULL,
  `ch9` int DEFAULT NULL,
  `ch10` int DEFAULT NULL,
  `ch11` int DEFAULT NULL,
  `ch12` int DEFAULT NULL,
  `ch13` int DEFAULT NULL,
  `ch14` int DEFAULT NULL,
  `ch15` int DEFAULT NULL,
  `ch16` int DEFAULT NULL,
  `ch17` int DEFAULT NULL,
  `freq1` varchar(10) DEFAULT NULL,
  `freq2` varchar(10) DEFAULT NULL,
  `freq3` varchar(10) DEFAULT NULL,
  `freq4` varchar(10) DEFAULT NULL,
  `freq5` varchar(10) DEFAULT NULL,
  `freq6` varchar(10) DEFAULT NULL,
  `freq7` varchar(10) DEFAULT NULL,
  `freq8` varchar(10) DEFAULT NULL,
  `freq9` varchar(10) DEFAULT NULL,
  `freq10` varchar(10) DEFAULT NULL,
  `freq11` varchar(10) DEFAULT NULL,
  `freq12` varchar(10) DEFAULT NULL,
  `freq13` varchar(10) DEFAULT NULL,
  `freq14` varchar(10) DEFAULT NULL,
  `freq15` varchar(10) DEFAULT NULL,
  `freq16` varchar(10) DEFAULT NULL,
  `freq17` varchar(10) DEFAULT NULL,
  `nota1` varchar(10) DEFAULT NULL,
  `nota2` varchar(10) DEFAULT NULL,
  `nota3` varchar(10) DEFAULT NULL,
  `nota4` varchar(10) DEFAULT NULL,
  `nota5` varchar(10) DEFAULT NULL,
  `nota6` varchar(10) DEFAULT NULL,
  `nota7` varchar(10) DEFAULT NULL,
  `nota8` varchar(10) DEFAULT NULL,
  `nota9` varchar(10) DEFAULT NULL,
  `nota10` varchar(10) DEFAULT NULL,
  `nota11` varchar(10) DEFAULT NULL,
  `nota12` varchar(10) DEFAULT NULL,
  `nota13` varchar(10) DEFAULT NULL,
  `nota14` varchar(10) DEFAULT NULL,
  `nota15` varchar(10) DEFAULT NULL,
  `nota16` varchar(10) DEFAULT NULL,
  `nota17` varchar(10) DEFAULT NULL,
  `prof1` varchar(100) DEFAULT NULL,
  `prof2` varchar(100) DEFAULT NULL,
  `prof3` varchar(100) DEFAULT NULL,
  `prof4` varchar(100) DEFAULT NULL,
  `prof5` varchar(100) DEFAULT NULL,
  `prof6` varchar(100) DEFAULT NULL,
  `prof7` varchar(100) DEFAULT NULL,
  `prof8` varchar(100) DEFAULT NULL,
  `prof9` varchar(100) DEFAULT NULL,
  `prof10` varchar(100) DEFAULT NULL,
  `prof11` varchar(100) DEFAULT NULL,
  `prof12` varchar(100) DEFAULT NULL,
  `prof13` varchar(100) DEFAULT NULL,
  `prof14` varchar(100) DEFAULT NULL,
  `prof15` varchar(100) DEFAULT NULL,
  `prof16` varchar(100) DEFAULT NULL,
  `prof17` varchar(100) DEFAULT NULL,
  `titulo1` varchar(45) DEFAULT NULL,
  `titulo2` varchar(45) DEFAULT NULL,
  `titulo3` varchar(45) DEFAULT NULL,
  `titulo4` varchar(45) DEFAULT NULL,
  `titulo5` varchar(45) DEFAULT NULL,
  `titulo6` varchar(45) DEFAULT NULL,
  `titulo7` varchar(45) DEFAULT NULL,
  `titulo8` varchar(45) DEFAULT NULL,
  `titulo9` varchar(45) DEFAULT NULL,
  `titulo10` varchar(45) DEFAULT NULL,
  `titulo11` varchar(45) DEFAULT NULL,
  `titulo12` varchar(45) DEFAULT NULL,
  `titulo13` varchar(45) DEFAULT NULL,
  `titulo14` varchar(45) DEFAULT NULL,
  `titulo15` varchar(45) DEFAULT NULL,
  `titulo16` varchar(45) DEFAULT NULL,
  `titulo17` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cert_done`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cert_done` WRITE;
/*!40000 ALTER TABLE `cert_done` DISABLE KEYS */;
INSERT INTO `cert_done` VALUES (16,'Psicopedagogia Institucional & Clínica','Pós-Graduação Lato Sensu',540,'2022-03-15','2023-09-15','2024-05-17','Izabel Cristina Izidoro de Souza Barbosa','Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','CEE/PE nº 86/2014','Alex Silva do Nascimento','Brasileiro','Pedra-PE','Severino Silva do Nascimento','Lúcia Rodrigues Silva do Nascimento','1995-09-04','9.315.642-SDS/PE','Licenciatura em Pedagogia','A Psicomotricidade no Processo de Ensino e Aprendezagem - 8,0','A Psicodedagogia e os Fundamentos dos Processos de Oralidade','A Psicopedagogia e os Fundamentos do Desenvolvimento do Raciocínio','Bases Psicomotoras da Aprendizagem','Bases Psicopedagógicas da Aprendizagem','Diagnóstico e Intervenção Psicopedagógica','Dificuldades da Aprendizagem','Estágio Supervisionado em Psicopedagogia Clínica','Estágio Supervisionado em Psicopedagogia Institucional','Fundamentos da Psicopedagogia','Metodologia do Trabalho Científico','Modalidades de Aprendizagem','Neurociências da Aprendizagem','Psicopatologia da Infância e da Adolescência','Psicopedagogia e Educação Inclusiva','Teoria do Conhecimento','Trabalho de Conclusão de Curso (TCC)','Transtornos Globais do Desenvolvimento',45,45,30,30,60,30,45,45,30,30,30,30,30,30,30,30,30,'100','100','100','100','100','100','100','100','100','100','100','100','100','100','100','100','100','10','10','10','9','7','10','9','10','9','10','10','10','9,5','9,5','10','8','10','Petronila Maria de Oliveira Santos Paes','José Diego Leite Santana','Alfredo Telino Leal de Lacerda','Vera Lúcia Maria C. Maciel Modesto','Karla Poliana de Barros','Maria José Guimarães','Célia Fernanda Beserra de Mello','Vera Lúcia Maria C. Maciel Modesto','Maria José Fraga','Thiago Maciel Ferreira','Patrícia Ivanca de Espíndola Gonçalves','Rosely Lisandra de Moraes','Eunice Magalhães Silva','Lucian Barbosa da Silva','José Diego Leite Santana','Thiago Maciel Ferreira','Amanda Lins Tavares Souza','Especialista','Mestre','Especialista','Especialista','Especialista','Mestre','Mestre','Especialista','Especialista','Mestre','Mestre','Mestre','Especialista','Especialista','Mestre','Mestre','Mestre'),(17,'UTI','Pós-Graduação Lato Sensu',500,'2024-09-04','2024-09-06','2024-09-24','Luciene','Escola Superior de Saúde de Arcoverde','168/2000','87/2015','Abel da Silva','Brasileiro','São Bernardo do Campo - SP','asdas','asdasd','2024-02-11','1355217695 - SSPBA','Graduado em Gestão Comercial','Fazdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'MBA em Negócios & Empreendedorismo','Pós-Graduação MBA',540,'2024-09-09','2024-09-12','2024-09-25','Izabel Cristina Izidoro de Souza Barbosa','Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','Aguardando','Marcelo de Souza Ribeiro','Brasileiro','São Bernardo do Campo - SP','Cosme da Silva Ribeiro','Maria Marlene de Souza Ribeiro','1981-11-18','1355217695 - SSPBA','Graduado em Gestão Comercial','Trabalho blá blá blá','Diagnóstico e Intervenção Psicopedagógica','Fundamentos da Psicopedagogia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,45,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100','100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Alfredo Telino Leal de Lacerda','Célia Fernanda Beserra de Mello',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Especialista','Mestre',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'UTI','Pós-Graduação Lato Sensu',500,'2024-09-17','2024-09-06','2024-09-28','lkjklnjlkn','Escola Superior de Saúde de Arcoverde','168/2000','87/2015','Marcelo de Souza Ribeiro','Brasileiro','São Bernardo do Campo - SP','Cosme da Silva Ribeiro','Maria Marlene de Souza Ribeiro','1981-11-18','1355217695 - SSPBA','Graduado em Gestão Comercial','erwrrrrrrrrrrc 10,0','UTI 1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Alfredo Telino Leal de Lacerda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Especialista',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'Ensino de Matemática','Pós-Graduação Lato Sensu',500,'2024-09-01','2024-09-21','2024-09-26','Izabel','Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','Não Informado','Marcelo de Souza Ribeiro','Brasileiro','São Bernardo do Campo - SP','Cosme da Silva Ribeiro','Maria Marlene de Souza Ribeiro','1981-11-18','1355217695 - SSPBA','Graduado em Gestão Comercial','Inteligência Artificial','Álgebra Aritmética','Desenho Geométrico e Construções Geométricas','Educação Etnomatemática: História e Cultura','Geometria Analítica','Geometria Plana e Espacial','História da Matemática','Laboratório de Matemática: Elaboração e Construção de Materiais Didáticos','Matemática Elementar (Funções E Trigonometria)','Metodologia do Trabalho Científico','Modelagem Matemática','Tecnologias Educacionais','Teorias da Aprendizagem','Trabalho de Conclusão de Curso - TCC',NULL,NULL,NULL,NULL,30,30,30,30,30,30,30,30,30,30,30,30,30,NULL,NULL,NULL,NULL,'100','100','100','100','100','100','100','100','100','100','100','100','100',NULL,NULL,NULL,NULL,'10','10','10','10','10','10','10','10','10','10','10','10','10',NULL,NULL,NULL,NULL,'Alfredo Telino Leal de Lacerda','Amanda Lins Tavares Souza','Célia Fernanda Beserra de Mello','José Diego Leite Santana','Eunice Magalhães Silva','Karla Poliana de Barros','Lucian Barbosa da Silva','Maria José Fraga','Maria José Guimarães','Patrícia Ivanca de Espíndola Gonçalves','Petronila Maria de Oliveira Santos Paes','Rosely Lisandra de Moraes','Thiago Maciel Ferreira',NULL,NULL,NULL,NULL,'Especialista','Mestre','Mestre','Mestre','Especialista','Especialista','Especialista','Especialista','Mestre','Mestre','Especialista','Mestre','Mestre',NULL,NULL,NULL,NULL),(21,'Especialização de Enfermagem em Urgência e Emergência','Pós-Graduação Lato Sensu',485,'2024-09-05','2024-09-20','2024-09-18','Luciene Nascimento','Escola Superior de Saúde de Arcoverde','168/2000','87/2015','Marcelo de Souza Ribeiro','Brasileiro','São Bernardo do Campo - SP','Cosme da Silva Ribeiro','Maria Marlene de Souza Ribeiro','1981-11-18','1355217695 - SSPBA','Graduado em Gestão Comercial','Enfermagem na pandemia. 8,0','Humanização Em Urgência E Classificação De Risco','Leitura De Exames Laboratoriais Em Emergência','Metodologia Científica','Orientação De TCC','Suporte Básico De Vida','Técnicas De Resgate E Salvamento','Urgências E Emergências Clínicas  E Cardiológicas','Urgências E Emergências Gineco-Obstétricas','Urgências E Emergências Pediátricas','Urgências E Emergências Psiquiátricas','Urgências E Emergências Traumáticas E Aph','Uso De Desfibrilador',NULL,NULL,NULL,NULL,NULL,12,20,24,75,10,20,72,24,52,20,146,10,NULL,NULL,NULL,NULL,NULL,'100','100','100','100','100','100','100','100','100','100','100','100',NULL,NULL,NULL,NULL,NULL,'10','9','10','10','10','10','9','8','9','10','9','10',NULL,NULL,NULL,NULL,NULL,'Alfredo Telino Leal de Lacerda','Amanda Lins Tavares Souza','Célia Fernanda Beserra de Mello','Eunice Magalhães Silva','José Diego Leite Santana','Karla Poliana de Barros','Lucian Barbosa da Silva','Maria José Fraga','Maria José Guimarães','Patrícia Ivanca de Espíndola Gonçalves','Petronila Maria de Oliveira Santos Paes','Rosely Lisandra de Moraes',NULL,NULL,NULL,NULL,NULL,'Especialista','Mestre','Mestre','Especialista','Mestre','Especialista','Especialista','Especialista','Mestre','Mestre','Especialista','Mestre',NULL,NULL,NULL,NULL,NULL),(22,'teste de curso','Pós-Graduação Stricto Sensu',100,'2024-08-30','2024-09-14','2024-09-26','Izabel Cristina Izidoro de Souza Barbosa','Escola Superior de Saúde de Arcoverde','168/2000','87/2015','João Samsnug da China','Brasileiro','Pedra - PE','José Nokia da Silva','Maria Motorola dos Santos','1995-04-04','154884','Licenciatura em Pedagogia','A Psicomotricidade no Processo de Ensino e Aprendezagem - 10,0','teste','teste2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100','100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10','7,6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Eunice Magalhães Silva','Célia Fernanda Beserra de Mello',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Especialista','Mestre',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'Especialização de Enfermagem em Urgência e Emergência','Pós-Graduação Lato Sensu',485,'2024-09-10','2024-09-20','2024-09-26','Luciene Nascimento','Escola Superior de Saúde de Arcoverde','168/2000','87/2015','João Samsnug da China Paraguai Lotus','Brasileiro','Pedra - PE','José Nokia da Silva','Maria Motorola dos Santos','1995-04-04','154884/SSPPE','Licenciatura em Pedagogia','Enfermagem na pandemia. 8,0','Humanização Em Urgência E Classificação De Risco','Leitura De Exames Laboratoriais Em Emergência','Metodologia Científica','Orientação De TCC','Suporte Básico De Vida','Técnicas De Resgate E Salvamento','Urgências E Emergências Clínicas  E Cardiológicas','Urgências E Emergências Gineco-Obstétricas','Urgências E Emergências Pediátricas','Urgências E Emergências Psiquiátricas','Urgências E Emergências Traumáticas E Aph','Uso De Desfibrilador',NULL,NULL,NULL,NULL,NULL,12,20,24,75,10,20,72,24,52,20,146,10,NULL,NULL,NULL,NULL,NULL,'100','100','100','100','100','100','100','100','100','100','100','100',NULL,NULL,NULL,NULL,NULL,'10','10','10','10','10','10','10','10','10','9','8','7',NULL,NULL,NULL,NULL,NULL,'Rosely Lisandra de Moraes','Patrícia Ivanca de Espíndola Gonçalves','Thiago Maciel Ferreira','Patrícia Ivanca de Espíndola Gonçalves','Amanda Lins Tavares Souza','Eunice Magalhães Silva','Thiago Maciel Ferreira','Célia Fernanda Beserra de Mello','Célia Fernanda Beserra de Mello','Maria José Guimarães','Thiago Maciel Ferreira','Amanda Lins Tavares Souza',NULL,NULL,NULL,NULL,NULL,'Mestre','Mestre','Mestre','Mestre','Mestre','Especialista','Mestre','Mestre','Mestre','Mestre','Mestre','Mestre',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cert_done` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `certificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificado` (
  `id_certificado` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_curso` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_professor` int NOT NULL,
  PRIMARY KEY (`id_certificado`),
  KEY `cert_idx` (`id_aluno`),
  KEY `curso_idx` (`id_curso`),
  KEY `disciplina_idx` (`id_disciplina`),
  KEY `professor_idx` (`id_professor`),
  CONSTRAINT `aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `professor` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `certificado` WRITE;
/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `c_horaria` int NOT NULL,
  `IES` varchar(100) DEFAULT NULL,
  `parecer` varchar(100) DEFAULT NULL,
  `parecer_curso` varchar(100) DEFAULT NULL,
  `tipo_curso` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (1,'Psicopedagogia Institucional & Clínica',540,'Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','CEE/PE nº 86/2014','Pós-Graduação Lato Sensu'),(2,'MBA em Negócios & Empreendedorismo',540,'Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','Aguardando','Pós-Graduação MBA'),(3,'Especialização de Enfermagem em Urgência e Emergência',485,'Escola Superior de Saúde de Arcoverde','168/2000','87/2015','Pós-Graduação Lato Sensu'),(4,'Ensino de Matemática',390,'Centro de Ensino Superior de Arcoverde','CEE/PE nº 167/2012','Não Informado','Pós-Graduação Lato Sensu'),(5,'teste de curso',100,'Escola Superior de Saúde de Arcoverde','168/2000','87/2015','Pós-Graduação Stricto Sensu');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `c_h` int NOT NULL,
  `id_curso` int NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `id_curso_idx` (`id_curso`),
  CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES (2,'Fundamentos da Psicopedagogia',30,2,1),(3,'Fundamentos da Psicopedagogia',30,1,1),(4,'Bases Psicopedagógicas da Aprendizagem',30,1,1),(5,'Bases Psicomotoras da Aprendizagem',30,1,1),(6,'Teoria do Conhecimento',30,1,1),(7,'Metodologia do Trabalho Científico',30,1,1),(8,'A Psicodedagogia e os Fundamentos dos Processos de Oralidade',45,1,1),(9,'A Psicopedagogia e os Fundamentos do Desenvolvimento do Raciocínio',45,1,1),(10,'Diagnóstico e Intervenção Psicopedagógica',60,1,1),(11,'Psicopedagogia e Educação Inclusiva',30,1,1),(12,'Modalidades de Aprendizagem',30,1,1),(13,'Neurociências da Aprendizagem',30,1,1),(14,'Dificuldades da Aprendizagem',30,1,1),(15,'Transtornos Globais do Desenvolvimento',30,1,1),(16,'Psicopatologia da Infância e da Adolescência',30,1,1),(17,'Estágio Supervisionado em Psicopedagogia Institucional',45,1,1),(18,'Estágio Supervisionado em Psicopedagogia Clínica',45,1,1),(19,'Trabalho de Conclusão de Curso (TCC)',30,1,1),(30,'Diagnóstico e Intervenção Psicopedagógica',45,2,1),(32,'Desenho Geométrico e Construções Geométricas',30,4,0),(33,'Educação Etnomatemática: História e Cultura',30,4,0),(34,'História da Matemática',30,4,0),(35,'Laboratório de Matemática: Elaboração e Construção de Materiais Didáticos',30,4,0),(36,'Metodologia do Trabalho Científico',30,4,1),(37,'Modelagem Matemática',30,4,1),(38,'Tecnologias Educacionais',30,4,1),(39,'Teorias da Aprendizagem',30,4,1),(40,'Álgebra Aritmética',30,4,0),(41,'Geometria Analítica',30,4,0),(42,'Geometria Plana e Espacial',30,4,0),(43,'Matemática Elementar (Funções E Trigonometria)',30,4,0),(44,'Trabalho de Conclusão de Curso - TCC',30,4,0),(45,'Humanização Em Urgência E Classificação De Risco',12,3,1),(46,'Metodologia Científica',24,3,1),(47,'Urgências E Emergências Clínicas  E Cardiológicas',72,3,1),(48,'Urgências E Emergências Gineco-Obstétricas',24,3,1),(49,'Urgências E Emergências Traumáticas E Aph',146,3,1),(50,'Orientação De TCC',75,3,1),(51,'Urgências E Emergências Pediátricas',52,3,1),(52,'Urgências E Emergências Psiquiátricas',20,3,1),(53,'Leitura De Exames Laboratoriais Em Emergência',20,3,1),(54,'Suporte Básico De Vida',10,3,1),(55,'Técnicas De Resgate E Salvamento',20,3,1),(56,'Uso De Desfibrilador',10,3,1),(57,'teste',30,5,1),(58,'teste2',45,5,1);
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor` (
  `id_professor` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (4,'Thiago Maciel Ferreira','Mestre'),(5,'Maria José Fraga','Especialista'),(7,'Alfredo Telino Leal de Lacerda','Especialista'),(8,'José Diego Leite Santana','Mestre'),(9,'Karla Poliana de Barros','Especialista'),(10,'Lucian Barbosa da Silva','Especialista'),(11,'Patrícia Ivanca de Espíndola Gonçalves','Mestre'),(12,'Rosely Lisandra de Moraes','Mestre'),(13,'Maria José Guimarães','Mestre'),(14,'Amanda Lins Tavares Souza','Mestre'),(15,'Eunice Magalhães Silva','Especialista'),(16,'Vera Lúcia Maria C. Maciel Modesto','Especialista'),(17,'Célia Fernanda Beserra de Mello','Mestre'),(18,'Petronila Maria de Oliveira Santos Paes','Especialista');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `perfil` int NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Marcelo Ribeiro','marcelocaricatus@hotmail.com','27e084d1588509d96025851d2a97f723',2),(3,'Seu Testador da Silva','teste@aesa.com','1f32aa4c9a1d2ea010adcf2348166a04',1),(4,'Laércio Coordenador','laercio@aesa.com','ac66e824d38631fe8d8fe128bb02d0ed',1),(5,'admin','admin@admin.com','c3284d0f94606de1fd2af172aba15bf3',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

