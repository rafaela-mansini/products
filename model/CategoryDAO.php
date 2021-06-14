<?php

require_once "Category.php";
require_once "DAO.php";

class CategoryDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT categories.*, count(products.id) as countProducts FROM categories LEFT JOIN products ON products.category_id = categories.id group by categories.id ORDER BY categories.id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Category', ['name', 'description', 'id', 'countProducts']);

            return $categories;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id ORDER BY name";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Category', ['name', 'description', 'id']);

            return $categories;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function countProducts($categoryId){
        $sql = "SELECT count(categories.id) as countProducts FROM categories INNER JOIN products ON products.category_id = categories.id WHERE categories.id = :categoryId";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->execute();

            $category = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Category', ['name', 'description', 'id', 'countProducts']);
            return $category;

        } catch (PDOException $th) {
            throw new PDOException($e);
        }
    }

    public function store($category){
        $sql = 'INSERT INTO categories SET name = :name, description = :description';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':name', $category->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':description', $category->getDescription(), PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            throw $e;
            return false;
        }
    }

    public function update($category)
    {
        $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $categoryId = $category->getId();
        $categoryName = $category->getName();
        $categoryDescription = $category->getDescription();

        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $categoryName, PDO::PARAM_STR);
        $stmt->bindParam(':description', $categoryDescription, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}
