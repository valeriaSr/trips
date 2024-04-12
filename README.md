Run project: 
  Go to the command line inside of the project and execute: docker compose up
  in another terminal run the command  docker exec -i -t php /bin/bash to get inside of the php container
  execute the command php bin/console doctrine:migrations:migrate
  Go to localhost and test the project!

  
Technical and Design decisions:
  I decided to use symfony framework because has many utils to create a crud aplication, also a web aplication
  I decided to not use rect neither vue.js because i was running out of time
  I try to use Live components for the dynamic form but i couldn't make it work completely.
  If I could have more time maybe I would try to use react because I like it so much. also I would improve the user experience.

Thank you for reading.
