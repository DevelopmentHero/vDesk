"use strict";
/**
 * Initializes a new instance of the Result class.
 * @class Represents a searchresult for Companies of a previous executed search.
 * @param {SearchResult} Result The Result of the searchresult.
 * @implements {vDesk.Search.IResult}
 * @memberOf vDesk.Contacts.Company.Search
 * @author Kerry <DevelopmentHero@gmail.com>
 * @version 1.0.0.
 */
vDesk.Contacts.Company.Search.Result = function Result(Result) {

    /**
     * The Company of the searchresult.
     * @type vDesk.Contacts.Company
     * @ignore
     */
    let Company = null;

    Object.defineProperties(this, {
        Viewer: {
            enumerable: true,
            get:        () => {
                if(Company === null) {
                    Company = vDesk.Contacts.Company.FromDataView(
                        vDesk.Connection.Send(
                            new vDesk.Modules.Command(
                                {
                                    Module:     "Contacts",
                                    Command:    "GetCompany",
                                    Parameters: {ID: Result.Data.ID},
                                    Ticket:     vDesk.User.Ticket
                                }
                            )
                        ).Data
                    );
                }
                return new vDesk.Contacts.Company.Viewer(Company).Control;
            }
        },
        Icon:   {
            enumerable: true,
            value:      "company"
        },
        Name:   {
            enumerable: true,
            value:      Result.Data.Name
        },
        Type:   {
            enumerable: true,
            value:      Result.Type
        }
    });
};
vDesk.Contacts.Company.Search.Result.Implements(vDesk.Search.IResult);
vDesk.Search.Results.Company = vDesk.Contacts.Company.Search.Result;