## Como Instalar
### Step 1: Obter o Código
#### Option 1: Git Clone

	git clone https://github.com/Luiz-Antonio-Junior/Gibimba.git

#### Option 2: Download the repository

    https://github.com/Luiz-Antonio-Junior/Gibimba/archive/main.zip

### Step 2: Use o Composer para instalar as dependências

	composer install
	
### Step 2: Use o NPM para instalar as dependências
    
    npm install

### Step 3: Configure o seu .env

Na pasta raiz do documento há um arquivo .env.example com o exemplo de como o seu .env deve ser configurado. Lembre-se de configurar corretamente o banco de dados.

### Step 4: Rode as Migrations

    php artisan migrate

### Step 4: Inicie o Webserver

    php artisan serve
    
### Step 5: Acesse a Aplicação

Acesse a URL retornada pelo comando php artisan serve e a abra no navegador, certifique-se de ter configurado o banco de dados corretamente.
