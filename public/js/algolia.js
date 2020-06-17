(function() {
    const client = algoliasearch("8R9JZ3YAXK", "640a0715a84403fbc365bf8270c3598b");
    const products = client.initIndex('products');

    autocomplete('#aa-search-input', {},
        {
            source: autocomplete.sources.hits(products, { hitsPerPage: 5 }),
            displayKey: 'name',
            templates: {
                header: '<div class="aa-suggestions-category">商品一覧</div>',
                suggestion(suggestion) {
                    return `<span>
                        ${suggestion._highlightResult.name.value}</span><span>${suggestion.price}</span>`;
                },
                empty:function (result) {
                    return `${result.query}の検索結果が見つかりません`
                },
            }
        }).on('autocomplete:selected',function (event,suggestion,dataset) {
                //window.location.origin = プロトコルやポートを含めたURLを取得する
                window.location.href = window.location.origin+'/shop/'+suggestion.slug;
    });
})();

