<?php
class OAuth2
{
    public function __construct()
    {
      require_once __DIR__ .'/config.php';
       
        global $mysql_api_config, $scope_array;
        $storage = new OAuth2\Storage\Pdo('mysql:dbname=my_oauth2_db;host=localhost', 'root', 'password');
        $server = new OAuth2\Server($storage, array('enforce_state' => true));
        $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
        $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
        $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));
        $server->addGrantType(new OAuth2\GrantType\RefreshToken($storage, array(
            'always_issue_new_refresh_token' => TRUE
        )));
        $server->setScopeUtil(new OAuth2\Scope(new OAuth2\Storage\Memory($scope_array)));
        $this->server = $server;
        $this->storage = $storage;
        $this->request = OAuth2\Request::createFromGlobals();
        $this->response = new OAuth2\Response();
    }
}
//    public function __invoke($request, $response, $next)
//    {
//        $server = $this->server;
//        $oauth_request = OAuth2\Request::createFromGlobals();
//        if (!$server->verifyResourceRequest($oauth_request, null, $this->scope)) {
//            return $this->unauthorized_response($response);
//        }
//        return $next($request, $response);
//    }
//
//    private function unauthorized_response($response) {
//        $body = Array(
//            'status' => 'error',
//            'error_description' => 'Unauthorized'
//        );
//        $response = $response->withStatus(401);
//        return $response->withJson($body);
//    }