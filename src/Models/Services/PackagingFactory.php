<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\Request;
use WalkerChiu\Core\Models\Exceptions\NotExpectedEntityException;
use WalkerChiu\Core\Models\Exceptions\NotUnsignedIntegerException;

class PackagingFactory
{
    /**
     * The data format from Repository.
     *
     * @var String
     */
    protected $output_format;

    /**
     * The query string variable used to store the page.
     *
     * @var String
     */
    protected $pageName;

    /**
     * The number of items to be shown per page.
     *
     * @var Int
     */
    protected $perPage;

    /**
     * The array variable used to specify a custom "select" clause for the query.
     *
     * @var Array
     */
    protected $fields;

    /**
     * The array variable used to add the associated translation fields.
     *
     * @var Array
     */
    protected $fields_lang;



    /**
     * Create a new factory instance.
     *
     * @param String  $output_format
     * @param String  $pageName
     * @param Int     $perPage
     * @return void
     */
    public function __construct($output_format = null, $pageName = null, $perPage = null)
    {
        $this->setOutputFormat($output_format);
        $this->setPageName($pageName);
        $this->setPerPage($perPage);

        $this->fields = [];
        $this->fields_lang = [];
    }


    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $output_format
     * @return void
     */
    public function setOutputFormat(?string $output_format): void
    {
        $this->output_format = is_null($output_format)
                                ? config('wk-core.output_format')
                                : $output_format;
    }

    /**
     * @param String  $pageName
     * @return void
     */
    public function setPageName(?string $pageName): void
    {
        $this->pageName = is_null($pageName)
                            ? config('wk-core.pagination.pageName')
                            : $pageName;
    }

    /**
     * @param Int  $perPage
     * @return void
     *
     * @throws NotUnsignedIntegerException
     */
    public function setPerPage(?int $perPage): void
    {
        if (
            !is_null($perPage)
            && (
                !is_integer($perPage)
                || $perPage <= 0
            )
        ) {
            throw new NotUnsignedIntegerException($perPage);
        }

        $this->perPage = is_null($perPage)
                            ? config('wk-core.pagination.perPage')
                            : $perPage;
    }

    /**
     * @param Array  $fields
     * @return void
     *
     * @throws NotExpectedEntityException
     */
    public function setFields(array $fields): void
    {
        if (
            !is_null($fields)
            && !is_array($fields)
        ) {
            throw new NotExpectedEntityException($fields);
        }

        $this->fields = $fields;
    }

    /**
     * @param Array  $fields_lang
     * @return void
     *
     * @throws NotExpectedEntityException
     */
    public function setFieldsLang(array $fields_lang): void
    {
        if (
            !is_null($fields_lang)
            && !is_array($fields_lang)
        ) {
            throw new NotExpectedEntityException($fields_lang);
        }

        $this->fields_lang = $fields_lang;
    }


    /*
    |--------------------------------------------------------------------------
    | Packaging
    |--------------------------------------------------------------------------
    */

    /**
     * @param Repository  $repository
     * @return Array|Collection|Eloquent
     */
    public function output($repository)
    {
        switch ($this->output_format) {
            case "collection":
                return $this->toCollection($repository);
            case "collection_pagination":
                return $this->toCollectionWithPagination($repository);
            case "array":
                return $this->toArray($repository);
            case "array_pagination":
                return $this->toArrayWithPagination($repository);
            default:
                return $repository;
        }
    }

    /**
     * @param Repository  $repository
     * @return Collection
     */
    public function toCollection($repository)
    {
        $fileds = $this->fields;

        return $repository->when($fileds, function ($query, $fileds) {
                                return $query->select(implode(',', $fileds));
                            })
                          ->get();
    }

    /**
     * @param Repository  $repository
     * @return Array
     */
    public function toArray($repository)
    {
        $fields_lang = $this->fields_lang;

        $records = $this->toCollection($repository)
                        ->toArray();

        if (empty($fields_lang)) {
            return $records;
        } else {
            $entities = $this->toCollection($repository);
            foreach ($entities as $entity) {
                foreach ($fields_lang as $field) {
                    array_merge($records, [
                        $field => $entity->findLangByKey($field)
                    ]);
                }
            }
            return $records;
        }
    }

    /**
     * @param Repository  $repository
     * @return Collection
     *
     * @throws NotUnsignedIntegerException
     */
    public function toCollectionWithPagination($repository)
    {
        $request = Request::instance();

        $page = $request->{$this->pageName};
        if (
            !is_null($page)
            && (
                !is_integer($page)
                || $page <= 0
            )
        ) {
            throw new NotUnsignedIntegerException($page);
        }

        $request->request->set('page', $page);

        $perPage = $this->perPage;
        if (
            !is_integer($perPage)
            || $perPage <= 0
        ) {
            throw new NotUnsignedIntegerException($perPage);
        }

        return $repository->paginate($perPage);
    }

    /**
     * @param Repository  $repository
     * @return Array
     */
    public function toArrayWithPagination($repository)
    {
        $fields_lang = $this->fields_lang;

        $records = $this->toCollectionWithPagination($repository)
                        ->toArray();

        if (empty($fields_lang)) {
            return $records;
        } else {
            $entities = $this->toCollectionWithPagination($repository);
            foreach ($entities as $entity) {
                foreach ($fields_lang as $field) {
                    array_merge($records, [
                        $field => $entity->findLangByKey($field)
                    ]);
                }
            }
            return $records;
        }
    }
}
