# 🎮 Portal de Games

Projeto desenvolvido em PHP com MySQL que simula um blog de notícias sobre jogos. O sistema permite cadastro de usuários, login, criação de notícias, comentários e gerenciamento de conteúdo.

---

## 🚀 Funcionalidades

* Cadastro e login de usuários
* Publicação de notícias
* Edição e exclusão de notícias
* Página individual de cada notícia
* Sistema de comentários
* Associação de notícias com jogos
* Filtro por plataforma (PC, PlayStation, Xbox)
* Dashboard administrativo
* Layout responsivo (mobile e desktop)

---

## 🛠️ Tecnologias utilizadas

* PHP
* MySQL
* HTML5
* CSS3
* PDO (conexão com banco de dados)

---

## 🗄️ Estrutura do Banco de Dados

O sistema utiliza as seguintes tabelas:

* `usuarios`
* `jogos`
* `noticias`
* `comentarios`

### Relacionamentos:

* Notícias → vinculadas a usuários (autor)
* Notícias → vinculadas a jogos
* Comentários → vinculados a notícias e usuários

---

## ⚙️ Como rodar o projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

### 2. Importar o banco de dados

* Criar banco `games`
* Importar o arquivo SQL disponível no projeto

### 3. Configurar conexão

Editar o arquivo:

```
/backend/conexao.php
```

Com seus dados:

```php
$host = "localhost";
$db = "games";
$user = "root";
$pass = "";
```

---

## 🌐 Acesso

Rodar via XAMPP ou outro servidor local:

```
http://localhost/games/games/public
```

---

## 🔐 Usuário padrão (opcional)

Criar manualmente ou via sistema:

* Email: [admin@email.com](mailto:admin@email.com)
* Senha: 123456

---

## 📁 Estrutura do Projeto

```
/backend
/public
/assets
/includes
/adm
```

---

## 📱 Responsividade

O projeto possui media queries para adaptação em:

* Celulares
* Tablets
* Desktop

---

## ❗ Observações

* O sistema utiliza `password_hash` e `password_verify` para segurança de senhas
* Necessário PHP 7+ e MySQL
* Recomenda-se uso do XAMPP para desenvolvimento local

---

## 👩‍💻 Autora

Projeto desenvolvido por Rafaela Lima para fins acadêmicos.

---

## 📌 Status

✔ Finalizado
✔ Funcional
✔ Pronto para hospedagem

---
