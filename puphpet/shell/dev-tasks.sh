#!/bin/bash

cd /vagrant

echo 'Installing Node packages...'
npm install >/dev/null
echo 'Done!'

echo 'Installing gems...'
bundle install >/dev/null
echo 'Done!'

#echo 'Updating composer packages...'
#composer update >/dev/null
#echo 'Done!'

echo "Box is fully provisioned @ http://192.168.56.200 :)"
