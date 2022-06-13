<style>
    .inventory_search_from{
        margin-top: 2%;
    }
    .inner-form{
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: flex-end;
    }
    .inner-form > .select-wrap{
        width: 10%;
    }
    .select-wrap select, .input-wrap input{
        width: 95%;
    }

    .inner-form > .input-wrap{
        width: 20%;
    }
    
</style>


<div class="inventory_search_from">
    <form action="search.php" method="get">
        <div class="inner-form">
            <div class="input-field select-wrap">
                <select name="cte_id" data-trigger>
                    <option value="" selected>카테고리</option>
                    <?php include_once('getCategory.php') ?>
                </select>
            </div>
            <div class="input-field select-wrap">
                <select name="type" data-trigger>
                    <option value="name" selected>제품명</option>
                    <option value="">3 Adults</option>
                    <option value="">4 Adults</option>
                    <option value="">5 Adults</option>
                </select>
            </div>
            <div class="input-field input-wrap">
                <input type="text"  name="keyword" placeholder="검색어를 입력하세요">
            </div>
            <div class="input-field fifth-wrap">
                <button class="btn-search" type="button" onClick="search(this);">SEARCH</button>
            </div>
        </div>
    </form>
</div>