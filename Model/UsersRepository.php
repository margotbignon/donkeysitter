<?php
abstract class UsersRepository {
    abstract public function getRow(int $id): array;
}