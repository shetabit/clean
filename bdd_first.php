Feature: get products list
    In Order to get product object
    As a visitor
    I can see json of product in endpoint

    Scenario: get product list successfully
        Given i have created 2 product
        When i send 'GET' request to '/api/products'
        Then i should receive json:
        """
        {"id" :1}
        """
