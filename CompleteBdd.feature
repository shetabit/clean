Feature: creating Order
    As a user
    In order to create order with products
    I allowed to see order details in API

    - Rules:
        each order should have 1 product at least

    Background: product fixtures
        Given I have created product with title "havij"
        And I have created product with title "sib"

    Scenario: save new order
        Given I am Unauthorized user
        When I send post req to "/api/orders"
        Then i should receive json:
        """
        {"errors" : [{"message": "no no no"}]}
        """
