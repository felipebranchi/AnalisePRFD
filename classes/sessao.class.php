<?php

/**
 * Classe de Sessões de login
 * @version 1.0
 * @author Renata Carvalho
 *
 */

class Sessao {

  /**
     * Nome do banco de dados onde está a tabela de usuários
     * 
     * @deprecated usar classe separada para definir acesso ao banco de dados (fititnt, 2016-06-09 03:45) 
     * 
     * @var string
     * @since v1.0
     */
    public $bancoDeDados = 'identrad';

    /**
     * Nome da tabela de usuários
     * 
     * @deprecated usar classe separada para definir acesso ao banco de dados (fititnt, 2016-06-09 03:45) 
     * 
     * @var string
     * @since v1.0
     */
    public $tabelaUsuarios = 'usuario';

    /**
     * Nomes dos campos onde ficam o usuário, a senha e o e-mail de cada usuário
     * 
     * Formato: tipo => nome do campo na tabela
     * 
     * O campo (email) só é necessário para o "Esqueci minha senha"
     * 
     * @var array
     * @since v1.0
     */
    public $campos = array(
        'usuario' => 'usuario',
        'senha' => 'password'
    );
    
    /**
     * Nomes dos campos que serão pegos da tabela de usuarios e salvos na sessão,
     * caso o valor seja false nenhum dado será consultado
     * 
     * @var mixed
     * @since v1.0
     */
    public $dados = array('id', 'nome');
    
    /**
     * Inicia a sessão se necessário?
     * 
     * @var boolean
     * @since v1.0
     */
    public $iniciaSessao = true;
    
    /**
     * Prefixo das chaves usadas na sessão
     * 
     * @var string
     * @since v1.0
     */
    public $prefixoChaves = 'usuario_';
    
    /**
     * Usa um cookie para melhorar para permitir autenticação? Sim.
     * 
     * @var boolean
     * @since v1.0
     */
    public $cookie = true;
    
    /**
     * O usuário e senha são case-sensitive?
     * 
     * Em valores case-sensitive "casa" é diferente de "CaSa" e de "CASA"
     * 
     * @var boolean
     * @since v1.1
     */
    public $caseSensitive = true;
    
    /**
     * Filtra os dados antes de consultá-los usando mysql_real_escape_string()?
     * 
     * @var boolean
     * @since v1.1
     */
    public $filtraDados = true;
    
    /**
     * Quantidade (em dias) que o sistema lembrará os dados do usuário ("Lembrar minha senha")
     * 
     * Usado apenas quando o terceiro parâmetro do método Usuario::logaUsuario() for true
     * Os dados salvos serão encriptados usando base64
     * 
     * @var integer
     * @since v1.1
     */
    public $lembrarTempo = 7;
    
    /**
     * Diretório a qual o cookie vai pertencer
     * Atenção: Não edite se você não souber o que está fazendo!
     * 
     * @var string
     * @since v1.1
     */
    public $cookiePath = '/';
    
    /**
     * Armazena as mensagens de erro
     * 
     * @var string
     * @since v1.0
     */
    public $erro = '';

    public function __construct()
    {
        //@todo temporariamente puxar para ca acesso ao banco de dados (fititnt, 2016-06-09 03:43)
        ;
    }
    
    /**
     * Codifica a senha do usuário em MD5
     * 
     * @access public
     * @since v1.0
     *
     * @param string $senha A senha que será codificada
     * @return string A senha já codificada
     */
    public function codificaSenha($senha) {
        
        // @todo Nao usar MD5. Usar BCrypt. Exemplo: http://stackoverflow.com/questions/4795385/how-do-you-use-bcrypt-for-hashing-passwords-in-php (fititnt, 2016-06-09 03:42)
        return md5($senha);
    }
    
    /**
     * Verifica se um usuário existe no sistema
     * 
     * @access public
     * @since v1.0
     * @uses Usuario::codificaSenha()
     * 
     * @param string $usuario O usuário que será validado
     * @param string $senha A senha que será validada
     * @return boolean Se o usuário existe
     */
    public function validaUsuario($usuario, $senha) {
        $senha = $this->codificaSenha($senha);
        
        // Filtra os dados
        if ($this->filtraDados) {
            $usuario = mysql_real_escape_string($usuario);
            $senha = mysql_real_escape_string($senha);
        }
        
        // Os dados são case-sensitive?
        $binary = ($this->caseSensitive) ? 'BINARY' : '';


        // Procura por usuários com o mesmo usuário e senha
        $sql = "SELECT COUNT(*) AS total
                FROM $this->bancoDeDados . $this->tabelaUsuarios
                WHERE $binary " . $this->campos['usuario'] . " = '$usuario'
                AND $binary " . $this->campos['senha'] . " = '$senha'";

        $query = mysql_query($sql);

        if ($query) {
            // Total de usuários encontrados
            $total = mysql_result($query, 0, 'total');
            
            // Limpa a consulta da memória
            mysql_free_result($query);
        } else {
            // A consulta foi mal sucedida, retorna false
            return false;
        }
        
        // Se houver apenas um usuário, retorna true
        return ($total == 1) ? true : false;
    }
    
    /**
     * Tenta logar um usuário no sistema salvando seus dados na sessão e cookies
     * 
     * @access public
     * @since v1.0
     * @uses Usuario::validaUsuario()
     * @uses Usuario::lembrarDados()
     *
     * @param string $usuario O usuário que será logado
     * @param string $senha A senha do usuário
     * @param boolean $lembrar Salvar os dados em cookies? (Lembrar minha senha)
     * @return boolean Se o usuário foi logado
     */
    public function logaUsuario($usuario, $senha, $lembrar = false) {            
        // Verifica se é um usuário válido
        if ($this->validaUsuario($usuario, $senha)) {
            echo "oi";
        
            // Inicia a sessão
            if ($this->iniciaSessao AND !isset($_SESSION)) {
                session_start();
            }
        
            // Filtra os dados
            if ($this->filtraDados) {
                $usuario = mysql_real_escape_string($usuario);
                $senha = mysql_real_escape_string($senha);
            }
            
            // Traz dados da tabela
            if ($this->dados != false) {
                // Adiciona o campo do usuário na lista de dados
                if (!in_array($this->campos['usuario'], $this->dados)) {
                    $this->dados[] = 'usuario';
                }
            
                // Monta o formato SQL da lista de campos
                $dados = join(', ', array_unique($this->dados));
        
                // Os dados são case-sensitive?
                $binary = ($this->caseSensitive) ? 'BINARY' : '';

                // Consulta os dados
                $sql = "SELECT $dados
                        FROM $this->bancoDeDados . $this->tabelaUsuarios
                        WHERE $binary " . $this->campos['usuario'] . "= '$usuario'";

                // @todo mysql_* não é compativel com PHP7+. Refratorar  (fititnt, 2016-06-09 04:01)
                $query = mysql_query($sql);
                
                // Se a consulta falhou
                if (!$query) {
                    // A consulta foi mal sucedida, retorna false
                    $this->erro = 'A consulta dos dados é inválida';
                    return false;
                } else {
                    // Traz os dados encontrados para um array
                    $dados = mysql_fetch_assoc($query);
                    // Limpa a consulta da memória
                    mysql_free_result($query);
                    
                    // Passa os dados para a sessão
                    foreach ($dados AS $chave=>$valor) {
                        $_SESSION[$this->prefixoChaves . $chave] = $valor;
                    }
                }
            }
            
            // Usuário logado com sucesso
            $_SESSION[$this->prefixoChaves . 'logado'] = true;
            
            // Define um cookie para maior segurança?
            if ($this->cookie) {
                // Monta uma cookie com informações gerais sobre o usuário: usuario, ip e navegador
                $valor = join('#', array($usuario, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
                
                // Encripta o valor do cookie
                $valor = sha1($valor);
                
                // Cria o cookie
                setcookie($this->prefixoChaves . 'token', $valor, 0, $this->cookiePath);
            }
            
            // Salva os dados do usuário em cookies? ("Lembrar minha senha")
            if ($lembrar) $this->lembrarDados($usuario, $senha);
            
            // Fim da verificação, retorna true
            return true;
            
                        
        } else {
            $this->erro = 'Usuário inválido';
            return false;
        }
    }
    
    /**
     * Verifica se há um usuário logado no sistema
     * 
     * @access public
     * @since v1.0
     * @uses Usuario::verificaDadosLembrados()
     *
     * @param boolean $cookies Verifica também os cookies?
     * @return boolean Se há um usuário logado
     */
    public function usuarioLogado($cookies = true) {
        // Inicia a sessão?
        if ($this->iniciaSessao AND !isset($_SESSION)) {
            session_start();
        }
        
        // Verifica se não existe o valor na sessão
        if (!isset($_SESSION[$this->prefixoChaves . 'logado']) OR !$_SESSION[$this->prefixoChaves . 'logado']) {
            // Não existem dados na sessão
            
            // Verifica os dados salvos nos cookies?
            if ($cookies) {
                // Se os dados forem válidos o usuário é logado automaticamente
                return $this->verificaDadosLembrados();
            } else {
                // Não há usuário logado
                $this->erro = 'Não há usuário logado';
                return false;
            }
        }
        
        // Faz a verificação do cookie?
        if ($this->cookie) {
            // Verifica se o cookie não existe
            if (!isset($_COOKIE[$this->prefixoChaves . 'token'])) {
                $this->erro = 'Não há usuário logado';
                return false;
            } else {
                // Monta o valor do cookie
                $valor = join('#', array($_SESSION[$this->prefixoChaves . 'usuario'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
    
                // Encripta o valor do cookie
                $valor = sha1($valor);
    
                // Verifica o valor do cookie
                if ($_COOKIE[$this->prefixoChaves . 'token'] !== $valor) {
                    $this->erro = 'Não há usuário logado';
                    return false;
                }
            }
        }
        
        // A sessão e o cookie foram verificados, há um usuário logado
        return true;
    }
    
    /**
     * Faz logout do usuário logado
     * 
     * @access public
     * @since v1.0
     * @uses Usuario::limpaDadosLembrados()
     * @uses Usuario::usuarioLogado()
     * 
     * @param boolean $cookies Limpa também os cookies de "Lembrar minha senha"?
     * @return boolean
     */
    public function logout($cookies = true) {
        // Inicia a sessão?
        if ($this->iniciaSessao AND !isset($_SESSION)) {
            session_start();
        }
        
        // Tamanho do prefixo
        $tamanho = strlen($this->prefixoChaves);

        // Destroi todos os valores da sessão relativos ao sistema de login
        foreach ($_SESSION AS $chave=>$valor) {
            // Remove apenas valores cujas chaves comecem com o prefixo correto
            if (substr($chave, 0, $tamanho) == $this->prefixoChaves) {
                unset($_SESSION[$chave]);
            }
        }
        
        // Destrói a sessão se ela estiver vazia
        if (count($_SESSION) == 0) {
            session_destroy();
            
            // Remove o cookie da sessão se ele existir
            if (isset($_COOKIE['PHPSESSID'])) {
                setcookie('PHPSESSID', false, (time() - 3600));
                unset($_COOKIE['PHPSESSID']);
            }
        }
        
        // Remove o cookie com as informações do visitante
        if ($this->cookie AND isset($_COOKIE[$this->prefixoChaves . 'token'])) {
            setcookie($this->prefixoChaves . 'token', false, (time() - 3600), $this->cookiePath);
            unset($_COOKIE[$this->prefixoChaves . 'token']);
        }
        
        // Limpa também os cookies de "Lembrar minha senha"?
        if ($cookies) $this->limpaDadosLembrados();
        
        // Retorna SE não há um usuário logado (sem verificar os cookies)
        return !$this->usuarioLogado(false);
    }
    
    /**
     * Salva os dados do usuário em cookies ("Lembrar minha senha")
     * 
     * @access public
     * @since v1.1
     * 
     * @param string $usuario O usuário que será lembrado
     * @param string $senha A senha do usuário
     * @return void
     */
    public function lembrarDados($usuario, $senha) {    
        // Calcula o timestamp final para os cookies expirarem
        $tempo = strtotime("+{$this->lembrarTempo} day", time());

        // Encripta os dados do usuário usando base64
        // O rand(1, 9) cria um digito no início da string que impede a descriptografia
        $usuario = rand(1, 9) . base64_encode($usuario);
        $senha = rand(1, 9) . base64_encode($senha);
    
        // Cria um cookie com o usuário
        setcookie($this->prefixoChaves . 'lu', $usuario, $tempo, $this->cookiePath);
        // Cria um cookie com a senha
        setcookie($this->prefixoChaves . 'ls', $senha, $tempo, $this->cookiePath);
    }
    
    /**
     * Verifica os dados do cookie (caso eles existam)
     * 
     * @access public
     * @since v1.1
     * @uses Usuario::logaUsuario()
     * 
     * @return boolean Os dados são validos?
     */
    public function verificaDadosLembrados() {
        // Os cookies de "Lembrar minha senha" existem?
        if (isset($_COOKIE[$this->prefixoChaves . 'lu']) AND isset($_COOKIE[$this->prefixoChaves . 'ls'])) {
            // Pega os valores salvos nos cookies removendo o digito e desencriptando
            $usuario = base64_decode(substr($_COOKIE[$this->prefixoChaves . 'lu'], 1));
            $senha = base64_decode(substr($_COOKIE[$this->prefixoChaves . 'ls'], 1));
            
            // Tenta logar o usuário com os dados encontrados nos cookies
            return $this->logaUsuario($usuario, $senha, true);        
        }
        
        // Não há nenhum cookie, dados inválidos
        return false;
    }
    
    /**
     * Limpa os dados lembrados dos cookies ("Lembrar minha senha")
     * 
     * @access public
     * @since v1.1
     * 
     * @return void
     */
    public function limpaDadosLembrados() {
        // Deleta o cookie com o usuário
        if (isset($_COOKIE[$this->prefixoChaves . 'lu'])) {
            setcookie($this->prefixoChaves . 'lu', false, (time() - 3600), $this->cookiePath);
            unset($_COOKIE[$this->prefixoChaves . 'lu']);            
        }
        // Deleta o cookie com a senha
        if (isset($_COOKIE[$this->prefixoChaves . 'ls'])) {
            setcookie($this->prefixoChaves . 'ls', false, (time() - 3600), $this->cookiePath);
            unset($_COOKIE[$this->prefixoChaves . 'ls']);            
        }
    }

    /**
     * Função para esquecimento de senha
     * 
     * @access public
     * @since v1.1
     * 
     * @return string
     */
    public function esqueciSenha($usuario) {        
        // Filtra os dados
        if ($this->filtraDados) {
            $usuario = mysql_real_escape_string($usuario);
        }
        
        // Os dados são case-sensitive?
        $binary = ($this->caseSensitive) ? 'BINARY' : '';


        // Procura por usuários com o mesmo usuário
        $sql = "SELECT COUNT(*) AS total
                FROM $this->bancoDeDados . $this->tabelaUsuarios
                WHERE $binary " . $this->campos['usuario'] . " = '$usuario'";

        $query = mysql_query($sql);

        if ($query) {
            // Total de usuários encontrados
            $total = mysql_result($query, 0, 'total');
            
            // Limpa a consulta da memória
            mysql_free_result($query);
        } else {
            // A consulta foi mal sucedida, retorna false
            return false;
        }
        
        // Se houver apenas um usuário, true
            $unico = ($total == 1) ? true : false;

        
        if ($unico) {
            // Pega senha
            $sql = "SELECT $this->tabelaUsuarios . " . $this->campos['senha'] . " AS senha
                FROM $this->bancoDeDados . $this->tabelaUsuarios
                WHERE $binary " . $this->campos['usuario'] . " = '$usuario'";

            $query = mysql_query($sql);

            if ($query) {
                // senha encontrada
                $senha = mysql_result($query, 0, 'senha');
                
                // Limpa a consulta da memória
                mysql_free_result($query);
            } else {
                // A consulta foi mal sucedida, retorna false
                return false;
            }
        } else {
            // Há mais de um usuário com este nome
            return false;
        }
        
        return $senha;
    }
}