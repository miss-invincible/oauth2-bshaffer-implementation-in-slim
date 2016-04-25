<?php

use Phinx\Migration\AbstractMigration;

class Db extends AbstractMigration
{
    public function up()
    {
        $oauth_clients = $this->table('oauth_clients',array('id'=>false,'primary_key'=>array("client_id")));
$oauth_clients->addColumn('client_id','string',array('limit'=>80,'null'=>false))
              ->addColumn('client_secret','string',array('limit'=>80))
              ->addColumn('redirect_uri','string',array('limit'=>2000,'null'=>false))
              ->addColumn('grant_types','string',array('limit'=>80))
              ->addColumn('scope','string',array('limit'=>100))
              ->addColumn('user_id','string',array('limit'=>80))
              ->save();

$oauth_access_tokens = $this->table('oauth_access_tokens',array('íd'=>false,'primary_key'=>array("access_token")));
$oauth_access_tokens->addColumn('access_token','string',array('limit'=>40,'null'=>false))
                    ->addColumn('client_id','string',array('limit'=>80,'null'=>false))
                    ->addColumn('user_id','string',array('limit'=>255))
                    ->addColumn('expires','timestamp',array('null'=>false))
                    ->addColumn('scope','string',array('limit'=>2000))
                    ->save();
                    
$oauth_authorization_codes = $this->table('oauth_authorization_codes',array('id'=>false,'primary_key'=>array('authorization_code')));
$oauth_authorization_codes->addColumn('authorization_code','string',array('limit'=>40,'null'=>false))
                          ->addColumn('client_id','string','string',array('limit'=>80,'null'=>false))
                          ->addColumn('user_id','string',array('limit'=>255))
                          ->addColumn('redirect_uri','string',array('limit'=>2000))
                          ->addColumn('expires','timestamp',array('null'=>false))
                          ->addColumn('scope','string',array('limit'=>2000))
                          ->save();

$oauth_refresh_tokens = $this->table('oauth_refresh_tokens',array('id'=>false,array('primary_key'=>array('refresh_token'))));
$oauth_refresh_tokens->addColumn('refresh_token','string',array('limit'=>40,'null'=>false))
                    ->addColumn('client_id','string',array('limit'=>80,'null'=>false))
                    ->addColumn('user_id','string',array('limit'=>255))
                    ->addColumn('expires','timestamp',array('null'=>false))
                    ->addColumn('scope','string',array('limit'=>2000))
                    ->save();

$oauth_users = $this->table('oauth_users',array('id'=>false,'primary_key'=>array(username)));
$oauth_users->addColumn('username','string',array('limit'=>255,'null'=>false))
            ->addColumn('password','string',array('limit'=>2000))
            ->addColumn('first_name','string',array('limit'=>255))
            ->addColumn('last_name','string',array('limit'=>255))
            ->save();

$oauth_scopes = $this->table('oauth_scopes');
$oauth_scopes->addColumn('scope','text')
              ->addColumn('is_default','boolean')
              ->save();

$oauth_jwt = $this->table('oauth_jwt',array('id'=>false,'primary_key'=>array('client_id')));
$oauth_jwt->addColumn('client_id','string',array('limit'=>80,'null'=>false))
          ->addColumn('subject','string',array('limit'=>80))
          ->addColumn('public_key','string',array('limit'=>2000))
          ->save();

    }

    public function down() {
        $this->dropTable('oauth_clients');
        $this->dropTable('oauth_access_tokens');
         $this->dropTable('oauth_authorization_codes');
        $this->dropTable('oauth_refresh_tokens');
         $this->dropTable('oauth_users');
        $this->dropTable('oauth_scopes');
         $this->dropTable('oauth_jwt');
       
    }
}