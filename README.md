# **Gerenciador-de-Artigos**

[![Licença MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)  
[![Versão](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)](https://semver.org/)  
[![Status: Desenvolvimento Completo](https://img.shields.io/badge/status-desenvolvimento%20completo-brightgreen.svg)]()

---

## Índice
* [Descrição do Projeto](#descrição)
* [Funcionalidades](#funcionalidades)
* [Tecnologias Utilizadas](#tecnologias-utilizadas)
* [Licença](#licença)
* [Como Executar o Projeto](#instalação-e-uso)
* [Autor do Projeto](#autor)

---

## **Descrição**
Uma aplicação web capaz de gerenciar de artigos, integrada a um banco de dados via php, com o foco de demonstrar habilidades aprendidas antes e durante as aulas. 

---

## **Funcionalidades**
- ✅ ***[Funcionalidade 1: Criar Artigos]***
- ✅ ***[Funcionalidade 2: Modificar Artigos]***
- ✅ ***[Funcionalidade 3: Deletar Artigos]***

---

## **Tecnologias Utilizadas**
- **Front-end**: ***[HTML5 e CSS]***
- **Back-end**: ***[PHP]***
- **Banco de dados**: ***[MYSQL]***

---

## **Licença**
Este projeto está licenciado sob a **Licença MIT**. Consulte o arquivo ***[LICENSE](LICENSE)*** para mais detalhes.

---

## **Instalação e Uso**

### **Pré-requisitos**

#### **Certifique-se de ter instalado:**
- ***[XAMP 8.2.12]***  
- ***[VSCode (Ou qualquer IDE)]***

#### **Certifique-se de ter criado:**
```sql
CREATE DATABASE GERENCIADOR;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL)

CREATE TABLE publicacao (
    id_publicacao INT AUTO_INCREMENT PRIMARY KEY,
    nome_publicacao VARCHAR(100) NOT NULL,
    descricao_publicacao VARCHAR(420) NOT NULL,
    autores_publicacao VARCHAR(100) NOT NUL,
    classificacao_autores VARCHAR(100) NOT NUL,
    divulgacao_publicacao VARCHAR(100) NOT NUL,
    convidados_publicacao VARCHAR(100) NOT NUL)
```

#### **Uso:**

1. **Descompactação do Projeto**: Feito o download do projeto, descompacte o arquivo em formato ZIP em uma pasta no seu htdocs do XAMP.
2. **Configuração do Banco de Dados**: Ative o MySQL no XAMP.
3. **Configuração do Ambiente**: Ative o Apache no XAMP.
4. **Execução do Projeto**: Abra seu browser e digite na url "http://localhost/(NOME_DA_PASTA)/" substituindo o (NOME_DA_PASTA), pelo nome da pasta que você criou anteriormente.

**Observação**: O arquivo "Extra" foi feito somente para atender algumas especificações que haviam no critério de nota, portanto, não faz parte do site.

---
  
## **Autor**

* [Bryan Lopes](https://github.com/BryanCSAL)
