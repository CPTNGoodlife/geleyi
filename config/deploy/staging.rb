set :stage, :staging
set :deploy_to, "/home/dele/webapps/test_geleyi"

server 'dele.webfactional.com', user: 'dele', roles: :all

fetch(:default_env).merge!(wp_env: :staging)

