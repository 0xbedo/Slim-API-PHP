<?php
// adding service to he contianer
$container->set(name: "JsonOperation", value: function ($c): JsonService {
  $json = new JsonService();
  return $json;
});
