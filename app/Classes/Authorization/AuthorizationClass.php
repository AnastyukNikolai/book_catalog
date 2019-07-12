<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */

class AuthorizationClass extends Authorization
{
	public function getPermissions() {
		return [
            'addBook' => [
                'description' => 'Add books',
            ],

            //---------------
            'addAuthor' => [
                'description' => 'Add authors',
            ],

            //---------------
            'addRubric' => [
                'description' => 'Add rubrics',
            ],

            //---------------
			'editBook' => [
					'description' => 'Edit any books',
				],

			//---------------
            'editAuthor' => [
                'description' => 'Edit any authors',
            ],

            //---------------
            'editRubric' => [
                'description' => 'Edit any rubrics',
            ],

            //---------------
			'deleteBook' => [
					'description' => 'Delete any books',
				],

            //---------------
            'deleteAuthor' => [
                'description' => 'Delete any authors',
            ],

            //---------------
            'deleteRubric' => [
                'description' => 'Delete any rubrics',
            ],
		];
	}

	public function getRoles() {
		return [
			'administrator' => [
                'addBook',
                'addAuthor',
                'addRubric',
                'editBook',
                'editAuthor',
                'editRubric',
                'deleteBook',
                'deleteAuthor',
                'deleteRubric',
				],
		];
	}


	/**
	 * Methods which checking permissions.
	 * Methods should be present only if additional checking needs.
	 */

	public function editOwnPost($user, $post) {
		$post = $this->getModel(\App\Post::class, $post);  // helper method for geting model

		return $user->id === $post->user_id;
	}

}
