
# ⚽ AllScout

**AllScout** é uma plataforma web desenvolvida para análise de desempenho de atletas e clubes de futebol. Seu principal objetivo é fornecer, de forma simples e objetiva, dados que auxiliem profissionais e entusiastas do esporte na tomada de decisões.

## 📌 Sobre o Projeto

O sistema permite:

- Consulta de informações detalhadas de atletas (com nota de desempenho "AllScout Index")
- Visualização de dados de clubes, como fundação, estádio, elenco e mais
- Acompanhamento de notícias esportivas
- Área administrativa para gerenciar atletas, clubes e usuários

Desenvolvido como Projeto Integrador do curso Técnico em Desenvolvimento de Sistemas do **SenacTech** – Porto Alegre, 2025.

## 🎯 Objetivos

### Objetivo Geral
Criar uma plataforma acessível e eficiente para análise de dados de jogadores de futebol.

### Objetivos Específicos
- Calcular e exibir o **AllScout Index** baseado em atributos técnicos e físicos dos atletas
- Fornecer informações completas sobre clubes de futebol
- Divulgar as principais notícias do cenário esportivo

## 🧱 Arquitetura do Sistema

### 👤 Atores
- **Usuário**: Consulta dados públicos de atletas e clubes, e pode favoritar jogadores
- **Administrador**: Gerencia atletas, clubes e usuários via painel administrativo

### ✅ Funcionalidades

- Autenticação de usuários e administradores
- Cadastro e edição de perfis
- CRUD completo para atletas, clubes e usuários
- Favoritar atletas
- Acesso a notícias e à seção "Sobre Nós"

### 🔐 Requisitos

#### Funcionais
- Login, cadastro e edição de usuários
- Gerenciamento de atletas e clubes
- Visualização e pesquisa por jogadores e clubes
- Sistema de favoritos e integração com notícias

#### Não Funcionais
- Backend em **PHP**
- Banco de dados **MySQL**
- Acesso protegido a dados sensíveis

## 🧮 Banco de Dados

O banco é estruturado com tabelas para:
- Usuários
- Atletas e suas características
- Clubes, títulos, estatísticas e ligação com atletas
- Liga, favoritos e triggers para cálculo automático de desempenho (`overall`)

Trecho da estrutura:
```sql
CREATE TABLE atletas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  nacionalidade VARCHAR(50),
  data_nascimento DATE,
  altura DECIMAL(3,2),
  ...
);
```

> O índice de desempenho **AllScout Index** é calculado automaticamente por triggers em função da posição do atleta.

## 🖥️ Telas do Sistema

O projeto conta com telas para:
- Login e Registro
- Perfil do Usuário
- Listagens de atletas e clubes
- Visualização de detalhes
- Área administrativa (CRUDs)
- Sobre nós e Notícias

Tecnologias:
- HTML5 + CSS3
- JavaScript (front-end)
- PHP (back-end com PDO)
- MySQL

## 🔄 CRUD Implementado

Operações realizadas no sistema:
- **Create**: Cadastro de usuários, atletas, clubes e características
- **Read**: Consulta pública e administrativa dos registros
- **Update**: Edição de dados no painel admin
- **Delete**: Exclusão de registros via painel

## 🧪 Testes

Foi implementado um **teste de carga**, que envia 1000 requisições usando `cURL`, para avaliar a estabilidade do sistema sob uso intenso.

```php
// Exemplo de trecho do teste
curl_setopt($ch, CURLOPT_URL, "http://localhost/allscout");
```

## 👥 Equipe

Projeto desenvolvido por:
- Claudio Roberto  
- Bashir Babalola  
- Davi Gabriel Boit Dos Santos  
- Lucas Laner Fornari  
- Gelson Junior Parahyba Loureiro  
- Mateus Cruz de Assumpção  

## 📚 Referências

- [SofaScore](https://www.sofascore.com)  
- [SportsBase](https://www.sportsbase.com)  
- [Globo Esporte](https://ge.globo.com)

## 📍 Local

Porto Alegre - RS  
SenacTech - 2025
