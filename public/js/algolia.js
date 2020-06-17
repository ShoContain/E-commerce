(function() {
    const client = algoliasearch("8R9JZ3YAXK", "640a0715a84403fbc365bf8270c3598b");
    const products = client.initIndex('products');

    autocomplete('#aa-search-input', {},
        {
            source: autocomplete.sources.hits(products, { hitsPerPage: 5 }),
            displayKey: 'name',
            templates: {
                header: '<div class="aa-suggestions-category">該当商品</div>',
                suggestion(suggestion) {
                    console.log(suggestion._highlightResult)
                    const price = suggestion.price.toLocaleString()
                    return `<span>
                        ${suggestion._highlightResult.name.value}</span>
                        <span>${suggestion._highlightResult.details.value}</span><span>${price}円</span>`;
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

