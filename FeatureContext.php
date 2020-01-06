<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \Tests\TestCase implements Context
{
    public $user;
    /**
     * @var int
     */
    private $apple;
    public $products = [];
    /**
     * @var \Illuminate\Foundation\Testing\TestResponse
     */
    private $response;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::setUp();
    }

    /**
     * @Given there are :arg1 cucumbers
     */
    public function thereAreCucumbers($arg1)
    {
        $this->apple = $arg1;
    }

    /**
     * @When I eat :arg1 cucumbers
     */
    public function iEatCucumbers($arg1)
    {
        $this->apple = $this->apple - $arg1;
    }

    /**
     * @Then I should have :arg1 cucumbers
     */
    public function iShouldHaveCucumbers($arg1)
    {
        $this->assertEquals($this->apple, $arg1);
    }

    /**
     * @Given i have created :arg1 product
     */
    public function iHaveCreatedProduct($arg1)
    {
        $this->products = [['id' => 1], ['id' => 2]];
    }

    /**
     * @When i send :arg1 request to :arg2
     */
    public function iSendRequestTo($arg1, $arg2)
    {
        $this->response = $this->getJson($arg2);
    }

    /**
     * @Then i should receive json:
     */
    public function iShouldReceiveJson(PyStringNode $string)
    {
        $response = $string->getRaw();
        $this->assertJsonStringEqualsJsonString($response, $this->response->getContent());
        $this->response->assertStatus(400);
    }

    /**
     * @Given I have created product with title :arg1
     */
    public function iHaveCreatedProductWithTitle($arg1)
    {
        $this->mockAPI = [
            'id' => 1,
            'message' => 'gadfa'
        ];
//        throw new PendingException();
    }

    /**
     * @Given I am Unauthorized user
     */
    public function iAmUnauthorizedUser()
    {
        Order::getTelegramContent($this->mockAPI);
//        throw new PendingException();
    }

    /**
     * @When I send post req to :arg1
     */
    public function iSendPostReqTo($arg1)
    {
        $this->response = $this->postJson($arg1);
    }
}
