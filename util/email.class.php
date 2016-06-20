<?php

require_once 'util/class.phpmailer.php'; 


/**
 * Classe que configura todos os envios de emails do sistema
 * @author Filipe Rodrigues
 *
 */
class Email
{
    private $mail;
    private $corpoRodape;
    
    public function __construct()
    {
        $this->mail = new PHPMailer();

        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->isSMTP(true); // Define que a mensagem será SMTP
        
        $this->mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $this->mail->Mailer = 'smtp';
        
        $this->mail->Host = AWS_HOST_SMTP; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
        $this->mail->Username = AWS_USERNAME; // Usuário do servidor SMTP (endereço de email)
        $this->mail->Password = AWS_PASSWORD; // Senha do servidor SMTP (senha do email usado)
     
        $this->mail->isHTML(true);
		
		$this->mail->SMTPDebug = 0;
		$this->mail->Port = AWS_PORT; // 587
       
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->From = "no-reply@robo3d.com.br"; // Seu e-mail
        $this->mail->FromName = "Robo 3D"; // Seu nome
        
        $this->configurarDadosPadroes();
    }

    /**
     * Configura alguns dados padrões dos e-mail de ações
     * do sistema, como assunto e rodapé do corpo do e-mail
     */
    private function configurarDadosPadroes()
    {
        // Configura o rodape do corpo do e-mail a ser enviado

        $this->corpoRodape  = "<br/><br/>Grande abraço!<br/>";
        $this->corpoRodape .= "Equipe Robô 3D<br/>";
        $this->corpoRodape .= "<a href='http://www.robo3d.com.br' target='_blank'>www.robo3d.com.br</a>";
    }

    /**
     * Envia um e-mail de acordo com 
     * as configuração dos atributos
     */
    private function enviar()
    { 
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        
        // Envia o e-mail
        $enviado = $this->mail->Send();
        
        //echo $this->mail->Body;
        
        // Limpa os destinatários e os anexos
        $this->mail->ClearAllRecipients();
        $this->mail->ClearAttachments();

        if ($enviado)
        {
            echo 'Enviou';
            //return true;
        }
        else
        {
            echo 'Não enviou';
            //return false;
        }
    }
    
    public function teste_envio()
    {
    	$this->mail->Subject = "Teste Robo3D";
    	$this->mail->AddAddress( 'frodrigues@anacom.com.br' );
    	
    	// Envia uma copia do e-mail
    	//$this->mail->addBCC( '' );
    	
    	// Configura o corpo do email
    	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    	$this->mail->Body  = "Oi <strong>" . 'Filipe Rodrigues' . "</strong>, tudo bem?<br/>";
    	
    	$this->mail->Body .= "Seja bem vindo a comunidade Robo 3D!<br/>";
    	$this->mail->Body .= "Esperamos que você aproveite o máximo que este portal pode te oferecer.<br/><br/> ";
    	
    	$this->mail->Body .= "Para você não esquecer:<br/> ";
    	$this->mail->Body .= "Endereço do portal: <a href='http://www.robo3d.com.br'>www.robo3d.com.br</a><br/>";
    	$this->mail->Body .= "Seu login: <strong>" . 'teste' . "</strong><br/>";
    	$this->mail->Body .= "Sua senha: <strong>" . 'teste' . "</strong> (pode ser alterada posteriormente)<br/><br/>";
    	//$this->mail->Body .= "Qualquer problema com acesso ao site, entre em contato através do e-mail: contato@robo3d.com.br";
    	
    	$this->mail->Body .= $this->corpoRodape;
    	
    	$enviar = $this->enviar();
    	
    	return $enviar;
    	
    }

    
    /**
     * Envia um e-mail de boas-vindas para o aluno
	 * com os dados de acesso
     * @param type $idEmpresa
     * @return type
     */
    public function enviarBoasVindas( $id_pessoa )
    {
		$sql  = 'select ';
		$sql .= 'a.nome, ';
		$sql .= 'a.email, ';
		$sql .= 'l.login, ';
		$sql .= 'l.senha, ';
		$sql .= 'e.nome as nome_educador ';
		$sql .= 'from login as l ';
		$sql .= 'inner join pessoa as a ';
		$sql .= 'on a.id_login = l.id_login ';
		$sql .= 'left join educador as e ';
		$sql .= 'on e.id_educador = a.id_educador ';
		$sql .= 'where a.id_pessoa = '. $id_pessoa .' ';
        
		$objBd = new BancodeDados();
		$result = $objBd->executarSQL($sql);
		$row = $result->fetch_array();
		
		$this->mail->Subject = "Seja bem vindo ao Pico!";
        $this->mail->AddAddress( trim( $row['email'] ) );
        
		// Envia uma copia do e-mail
		//$this->mail->addBCC( '' );
		
        // Configura o corpo do email
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->Body  = "Oi <strong>" . $row['nome'] . "</strong>, tudo bem?<br/>";
        
        $this->mail->Body .= "Seja bem vindo ao Programa de Integração do Conhecimento, o PICO!<br/>";
        $this->mail->Body .= "Esperamos que você aproveite o máximo que este portal pode te oferecer.<br/><br/> ";
        
        $this->mail->Body .= "Para você não esquecer:<br/> ";
		$this->mail->Body .= "Endereço do portal: <a href='http://www.programapico.com.br'>www.programapico.com.br</a><br/>";
        $this->mail->Body .= "Seu login: <strong>" . $row['login'] . "</strong><br/>";
        $this->mail->Body .= "Sua senha: <strong>" . $row['senha'] . "</strong> (pode ser alterada posteriormente)<br/><br/>";
		$this->mail->Body .= "Qualquer problema com acesso ao site, entre em contato através do e-mail: contato@programapico.com.br";
	
        $this->mail->Body .= $this->corpoRodape;
		
        $enviar = $this->enviar();

        return $enviar;
    }
    
    
    /**
     * Envia a senha para o email vinculado
     * @param unknown $email
     * @param unknown $senha
     * @return boolean
     */
    public function enviarSenhaRecuperada( $row )
    {
    	$this->mail->Subject = "Senha - robo 3d!";
    	$this->mail->AddAddress( $row['email'] );
    
    	// Configura o corpo do email
    	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    	$this->mail->Body  = "Oi <strong>" . $row['nome'] . "</strong>, tudo bem?<br/>";
    	$this->mail->Body .= "Sua senha foi recuperada com sucesso!<br/><br/> ";
    
    	$this->mail->Body .= "Para você não esquecer:<br/> ";
    	$this->mail->Body .= "Endereço do portal: ";
    	$this->mail->Body .= "Seu login: <strong>" . $row['login'] . "</strong><br/>";
    	$this->mail->Body .= "Sua senha: <strong>" . $row['senha'] . "</strong><br/><br/>";
    	$this->mail->Body .= "Qualquer problema com acesso ao site, entre em contato através do e-mail: contato@robo3d.com.br";
    
    	$this->mail->Body .= $this->corpoRodape;
    
    	$enviar = $this->enviar();
    
    	return $enviar;
    }

}
?>