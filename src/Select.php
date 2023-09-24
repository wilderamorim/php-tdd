<?php

namespace App;

class Select
{
    protected string $query;
    protected ?string $where = null;
    protected ?string $oderBy = null;
    protected ?string $limit = null;
    protected ?string $join = null;

    public function __construct(protected string $table)
    {
        $this->query = "SELECT * FROM {$this->table}";
    }

    public function where(string $column, string $operator, ?string $value, string $concat = 'AND'): self
    {
        $value = is_null($value) ? ":{$column}" : $value;

        if (!$this->where) {
            $this->where .= " WHERE {$column} {$operator} {$value}";
        } else {
            $this->where .= " {$concat} {$column} {$operator} {$value}";
        }

        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): self
    {
        $this->oderBy = " ORDER BY {$column} {$order}";
        return $this;
    }

    public function limit(int $limit, int $offset = 0): self
    {
        $this->limit = " LIMIT {$limit}, {$offset}";
        return $this;
    }

    public function getQuery(): string
    {
        return $this->query . $this->join . $this->where . $this->oderBy . $this->limit;
    }

    public function join(string $kind, string $table, string $column, string $operator, string $value, string $concat = 'AND'): self
    {
        /*
        if (!$this->join) {
            $this->join .= " {$kind} {$table} ON {$column} {$operator} {$value}";
        } else {
            $this->join .= " {$concat} {$column} {$operator} {$value}";
        }
        */

        $this->join .= " {$kind} {$table} ON {$column} {$operator} {$value}";

        return $this;
    }
}