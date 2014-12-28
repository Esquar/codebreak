#!/usr/bin/python

#
# @TODO: Criar conexao no banco administrativo para buscar os clientes e seus ambientes
#
         
import redis

print "\n"
print "Conectando no db[0]"

#inicializo a instancia do RedisCli
MasterDb = redis.StrictRedis(host='localhost', port='6379', db=0)

print "."
print ".."
print "..."
print "db[0] Conectado!!\n"

print "Limpando db[0]"
print "."
print ".."
print "..."

#deleto o banco antigo
MasterDb.flushdb()
print "db[0] limpo e pronto para reset!!\n"

#configuracoes do servico master ('www')
ConfDict = {
   'EnvName'            : 'www',
   'CacheDBIndex'       : 1,
   'CacheConfigIndex'   : 2
}

#insiro a chave no db[0] do redis
print "Criando chave de config no db[0]"
print "."
print ".."
MasterDb.hmset('www', ConfDict)
print "..."
print "Criada!"

for k in MasterDb.keys('*'):
   print k,":",MasterDb.hgetall(k) , "\n"

#destruo a variavel de configuracao para evitar vasamento de dados
del ConfDict


print MasterDb.hget('www', 'CacheConfigIndex')

#inicializo o CacheDB::CacheConfigIndex para gravar as configs do banco
RootDb = redis.StrictRedis(host='localhost', port='6379', db=MasterDb.hget('www', 'CacheConfigIndex'))
RootDb.flushdb()

ConfDict = {
   'hostname' : 'localhost',
   'username' : 'postgres',
   'password' : 'teste',
   'database' : 'master',
   'dbdriver' : 'postgre',
   'dbprefix' : '',
   'pconnect' : True,
   'db_debug' : True,
   'cache_on' : False,
   'cachedir' : '',
   'char_set' : 'utf8',
   'dbcollat' : 'utf8_general_ci',
   'swap_pre' : '',
   'autoinit' : True,
   'stricton' : False,
   'port'     : 5432
}

RootDb.hmset('db_config', ConfDict)

for k in RootDb.keys('*'):
   print k,":",RootDb.hgetall(k) , "\n"

