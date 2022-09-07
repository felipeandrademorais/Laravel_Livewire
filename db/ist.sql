/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE `ist`;
USE `ist`;

# Dump of table pessoas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pessoas`;

CREATE TABLE `pessoas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL DEFAULT '',
  `cpf` varchar(11) NOT NULL DEFAULT '',
  `cep` varchar(8) NOT NULL DEFAULT '',
  `numero` text NOT NULL,
  `logradouro` text NOT NULL DEFAULT '',
  `bairro` text NOT NULL DEFAULT '',
  `estado` text NOT NULL DEFAULT '',
  `municipio` text NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;

INSERT INTO `pessoas` (`id`, `nome`, `cpf`, `cep`, `numero`, `logradouro`, `bairro`, `estado`, `municipio`)
VALUES
 (1, 'Marcelo Ramos', '48349778032', '88705001', '10', 'Rua Luiz Demo', 'Passagem', 'SC', 'Tubarão'),
 (2, 'Renato Silva', '76537136024', '88705001', '10', 'Rua Luiz Demo', 'Passagem', 'SC', 'Tubarão'),
 (3, 'Maria Cordeiro', '01054804010', '88705001', '10', 'Rua Luiz Demo', 'Passagem', 'SC', 'Tubarão');

/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `conta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(10) unsigned NOT NULL,
  `conta` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `conta_id_pessoa_foreign` (`id_pessoa`),
  CONSTRAINT `conta_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `movimentacao` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(10) unsigned NOT NULL,
  `id_conta` bigint(20) unsigned NOT NULL,
  `valor` double(8,2) NOT NULL,
  `tipo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `movimentacao_id_pessoa_foreign` (`id_pessoa`),
  KEY `movimentacao_id_conta_foreign` (`id_conta`),
  CONSTRAINT `movimentacao_id_conta_foreign` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id`),
  CONSTRAINT `movimentacao_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
