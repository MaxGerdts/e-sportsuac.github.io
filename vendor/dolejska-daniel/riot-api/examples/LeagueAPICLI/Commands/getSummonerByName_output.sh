#!/usr/bin/env sh
../../../src/LeagueAPICLI/leagueapicli summoner:get-by-name "I am TheKronnY" \
  --pretty --config ../config.json --output ./summoner-iamthekronny.json
echo
echo Press any key to continue . . .
read