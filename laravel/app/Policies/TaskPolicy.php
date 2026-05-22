<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
   public function view()
   {
    return false;
   }

   public function viewAny()
   {
    return false;
   }

   public function create()
   {
    return false;
   }

   public function forceDelete()
    {
        return false;
    }

    public function restore()
    {
        return false;
    }



    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id || $user->isAdmin();
    }
}
