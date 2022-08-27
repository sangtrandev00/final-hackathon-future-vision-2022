import Debug "mo:base/Debug";
import Hash "mo:base/Hash";
import HashMap "mo:base/HashMap";
import Iter "mo:base/Iter";
import Nat "mo:base/Nat";
import Principal "mo:base/Principal";
import Result "mo:base/Result";
import Text "mo:base/Text";
import Time "mo:base/Time";
import Trie "mo:base/Trie";

actor {

  // Fund Donation Type

  public type FundDonation = {
    FundId: Text;
    Name : Text;
    Email: Text;
    Phone : Text;
    DonateMoney: Float;
    NameProject: Text;
    Message: Text;
    TimeDonate: Text;
    FundProjectId: Text;
    TypeProject: Text;
  };

    // Fund Project Type
    public type FundProject = {
    ProjectID: Text;
    ProjectName: Text;
    ProjectType: Text;
    DateStart: Text;
    DateEnd: Text;
    CurrentMoney: Float;
    TargetMoney: Float;
    ImgUrl: Text;
    Location: Text;
    ShortDesc: Text;
    FullDesc: Text;
  };

  public type Disbursement = {
    DisbursementID: Nat;
    ProjectID: Text;
    TypeProject: Text;
    UserRequest: Text;
    DateRequest: Text;
    DateConfirm: Text;
    UserConfirm: Text;
    Reason: Text;
    DisbursementMoney: Float;
  };


   //application state
  // public type Customer = Types.Customer;
  private var FundDonationMaps : HashMap.HashMap<Text, ?FundDonation> = HashMap.HashMap(1, Text.equal, Text.hash);
  private var FundProjectMaps : HashMap.HashMap<Text, ?FundProject> = HashMap.HashMap(1, Text.equal, Text.hash);
  private var DisbursementMaps : HashMap.HashMap<Nat, ?Disbursement> = HashMap.HashMap(0, Nat.equal, Hash.hash);
  private var totalBalance = 0;

  stable var fundDonationEntries: [(Text, ?FundDonation)] = [];
  stable var fundProjectEntries: [(Text, ?FundProject)] = [];
  stable var disbursementEntries: [(Nat, ?Disbursement)] = [];
  
  //Create Donation -- C
  public func createDonation(FundId_: Text, Name_ : Text,Email_ : Text, Phone_ : Text, DonateMoney_: Float, NameProject_:Text, Message_: Text,TimeDonate_: Text, FundProjectId_: Text,TypeProject_: Text) : async Bool {
    let currentDonation: FundDonation = {
      FundId= FundId_;
      Name = Name_;
      Email= Name_;
      Phone = Phone_;
      DonateMoney= DonateMoney_;
      NameProject= NameProject_;
      Message= Message_;
      TimeDonate = TimeDonate_;
      FundProjectId = FundProjectId_;
      TypeProject = TypeProject_; 
    };

    FundDonationMaps.put(FundId_, ?currentDonation);
    // next += 1;
    return true;
  };



  // Create Fund Project
  // createDisbursement
   public func createDisbursement(DisbursementID_: Nat, ProjectID_ : Text,TypeProject_ : Text, UserRequest_ : Text, DateRequest_: Text, DateConfirm_:Text, UserConfirm_: Text,Reason_: Text,DisbursementMoney_: Float) : async Bool {

    let currentDisbursement: Disbursement = {
          DisbursementID=  DisbursementID_;
          ProjectID = ProjectID_;
          TypeProject =  TypeProject_;
          UserRequest =  UserRequest_;
          DateRequest =  DateRequest_;
          DateConfirm =  DateConfirm_;
          UserConfirm =  UserConfirm_;
          Reason =  Reason_;
          DisbursementMoney =  DisbursementMoney_;
          // NumberDisbursement =  NumberDisbursement_;
    };

    DisbursementMaps.put(DisbursementID_, ?currentDisbursement);
    return true;
  };


  // Create a  Disbursement Transaction and store in maps

 public func createFundProject(ProjectID_: Text, ProjectName_ : Text,ProjectType_ : Text, DateStart_ : Text, DateEnd_: Text,CurrentMoney_: Float, TargetMoney_:Float, ImgUrl_: Text,Location_: Text,ShortDesc_: Text, FullDesc_: Text ) : async Bool {

    let currentFundProject: FundProject = {
      ProjectID = ProjectID_;
      ProjectName = ProjectName_;
      ProjectType= ProjectType_;
      DateStart = DateStart_;
      DateEnd = DateEnd_;
      CurrentMoney = CurrentMoney_;
      TargetMoney= TargetMoney_;
      ImgUrl= ImgUrl_;
      Location = Location_;
      ShortDesc = ShortDesc_;
      FullDesc = FullDesc_;
    };

    FundProjectMaps.put(ProjectID_, ?currentFundProject);
    return true;
  };


  //account deletion (basically set the customer to null)
  // public func delete_account(id : Text) : async Bool {
  //   switch (FundDonationMaps.get(id)){
  //     case(null) {
  //       return false;
  //     };
  //     // Tai sao khong remove luon ma phai dung put ( next, null nhi);
  //     case (?fundDonation) {
  //       Debug.print("id: " #debug_show(id));
  //       // customers.put(id, null);
  //       FundDonationMaps.delete(id);
  //       return true;
  //     };
  //   }
  // };

  //debug function --> Reaqd all Fund Donate
  public query func view_all_entries() : async [(Text, ?FundDonation)] {
    return Iter.toArray(FundDonationMaps.entries());
  };


  // Debug function --> Read all fund projects
  public query func view_all_projects() : async [(Text, ?FundProject)] {
    return Iter.toArray(FundProjectMaps.entries());
  };

  // Debug function --> Read all disbursements.
  public query func view_all_disbursements() : async [(Nat, ?Disbursement)] {
    return Iter.toArray(DisbursementMaps.entries());
  };
  

  // public query func view_donation_list(): async [?FundDonation] {

  //     var donationEntries = Iter.toArray(FundDonationMaps.entries());
  //     var donationList:[FundDonation] = donationEntries.map<[(Text,?FundDonation)], Bool>(donationEntries, func(donation: FundDonation): Bool {
  //       return donation[1];
  //     });

  //     return donationList;
  // };
  
  //entry viewer
  // public query func view_entry(id : Nat) : async [(Text, ?FundDonation)] {
  //   switch (fundDonationEntries.get(id)) {
  //     case (null) {
  //       let resultlist : [(Nat, ?FundDoantion)] = [(id, null)];
  //       return resultlist;
  //     };
  //     case (?value) {
  //       let resultlist : [(Nat, ?FundDoantion)] = [(id, value)];
  //     }
  //   };
  // };

  public query func view_donation(fundIdText_ : Text): async ?FundDonation {
    switch(FundDonationMaps.get(fundIdText_)) {
      case null {
        return null;
      };
      case (?result) {
        return result;
      }
    }
  };


  public  query   func view_fund_project(fundProjectIdText_ : Text): async ?FundProject {
    switch(FundProjectMaps.get(fundProjectIdText_)) {
      case null {
      
        return null;
      };
      case (?result) {
        return result;
      }
    }
  };

  public  query   func view_disbursement(disbursement_id : Nat): async ?Disbursement {
    switch(DisbursementMaps.get(disbursement_id)) {
      case null {
        return null;
      };
      case (?result) {
        return result;
      }
    }
  };

  // public func update_fund_project(newFundProject_: FundProject): async Bool {
  //   // switch(Text.equal(newFundProject_.IdFundProject,))
  // }

  public query func sizeOfFundDonationMaps(): async Nat {
    return FundDonationMaps.size();
  };
  public query func sizeOfFundProjectMaps(): async Nat {
    return  FundProjectMaps.size();
  };
  public query func sizeOfDisbursementMaps(): async Nat {
    return DisbursementMaps.size();
  };

  // Read account

  public query func readDonateInfo() : async [?FundDonation] {
    return Iter.toArray(FundDonationMaps.vals());
  };

  public query func readKeyDonateInfo() : async [Text] {
    return Iter.toArray(FundDonationMaps.keys());
  };

  public query func readValueDisbursementInfos() : async [?Disbursement] {
    return Iter.toArray(DisbursementMaps.vals());
  };
  public query func readValueProjectsInfos() : async [?FundProject] {
    return Iter.toArray(FundProjectMaps.vals());
  };

  // stable var customerSize : Nat = customers.size();

  system func preupgrade() {
    fundDonationEntries := Iter.toArray(FundDonationMaps.entries());
    fundProjectEntries := Iter.toArray(FundProjectMaps.entries());
    disbursementEntries := Iter.toArray(DisbursementMaps.entries());
    // disbursementEntries:= Iter.toArray(DisbursementMaps.entries());
  };

  system func postupgrade() {
    FundDonationMaps := HashMap.fromIter<Text, ?FundDonation>(fundDonationEntries.vals(), 0, Text.equal, Text.hash);
    FundProjectMaps := HashMap.fromIter<Text, ?FundProject>(fundProjectEntries.vals(), 0, Text.equal, Text.hash);
    DisbursementMaps := HashMap.fromIter<Nat, ?Disbursement>(disbursementEntries.vals(), 0, Nat.equal, Hash.hash);
  };

  Debug.print("hello");

};
