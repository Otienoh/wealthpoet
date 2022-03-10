<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;

class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \App\Models\Transaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var  string
     */
    public static $title = 'transaction_reference';

    /**
     * The columns that should be searched.
     *
     * @var  array
     */
    public static $search = [
        'id', 'description', 'amount', 'transaction_reference'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Transactions');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Transaction');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('Id'), 'id')->rules('required'),
            Hidden::make('Owned By', 'user_id')->default(function ($request) {
                return $request->user()->getKey();
            }),
            BelongsTo::make('Account')->rules('required'),
            BelongsTo::make('Category')->rules('required'),
            Text::make(__('Description'), 'description')->rules('required'),
            Text::make(__('Amount'), 'amount')->rules('required'),
            Date::make(__('Transaction Date'), 'transaction_date')->rules('required'),
            Text::make(__('Transaction Reference'), 'transaction_reference')->rules('required'),
            Text::make(__('Transactionable Type'), 'transactionable_type')->rules('required'),
            Text::make(__('Transactionable Id'), 'transactionable_id')->rules('required'),
            Text::make(__('Debit'), 'debit')->rules('required'),
            Text::make(__('Credit'), 'credit')->rules('required'),
            Boolean::make(__('Hidden'), 'hidden')->rules('required'),
            Text::make(__('Extra Data'), 'extra_data'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
