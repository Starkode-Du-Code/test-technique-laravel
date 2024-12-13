<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(302); // Vérifie que la redirection se fait correctement
    $response->assertRedirect('/posts'); // Vérifie la destination de la redirection
});

