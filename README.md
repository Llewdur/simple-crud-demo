## About

A simple Laravel CRUD demonstration

## To run
sail artisan migrate:fresh --seed && sail artisan test

## Notes

Assumptions:
"Interests". The user can only select from existing interests and no enter their own
No reset password option requested or provided
No activation option requested or provided
No email styling done as we dont have a CI

I deliberately did not add RefreshDatabase to the tests
I did not cater for user add/edit when no languages/interests are available for selection
I would have normally provided the solution as APIs but opted for the simpler solution to save on time
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
