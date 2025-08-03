import React, { useEffect, useState, useContext } from "react";
import { useNavigate, useParams } from "react-router-dom";
import axios from "axios";
import uploadImageToCloudinary from "../CloudServices/cloudinaryServices";
import { UserContext } from "../Context/UserContext";
import defaultProfilePicture from "../Assets/profile.svg";
import Loader from "../Components/Loader";
import ToastMsg from "../Components/ToastMsg";

const categoriesList = [
  "Cosmetics & Makeup",
  "Skin Care",
  "Beverages & Drinks",
  "Fitness & Gym Products",
  "App & Website Promotions",
  "Clothing Brands",
  "Furniture Brands",
  "Food & Beverages",
  "Footwear",
  "Farming & Agriculture",
  "Toys & Games",
  "Electronics & Gadgets",
  "Home & Living",
  "Kitchen Appliances",
  "Pet Products",
  "Beauty & Health",
  "Groceries",
  "Sports & Fitness",
  "Bags & Luggage",
  "Baby Products & Toys",
  "Kids' Fashion",
  "Automotive & Industrial",
  "Books & Literature",
  "Movies & Entertainment",
  "Video Games",
  "Mobiles & Computers",
  "TV & Appliances",
  "Men's Fashion",
  "Women's Fashion",
  "Healthcare & Wellness",
  "Travel & Tourism",
  "Education & E-learning",
  "Real Estate",
  "Jewelry & Accessories",
  "Financial Services",
  "Technology & Software",
  "Art & Design",
  "Music & Instruments",
  "Event Planning",
  "Hospitality & Restaurants",
];

const UpdateInfluencer = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { currentUser } = useContext(UserContext);
  const [influencer, setInfluencer] = useState({
    username: "",
    email: "",
    name: "",
    bio: "",
    profilePicture: defaultProfilePicture,
    socialMediaLinks: {
      youtube: "",
      instagram: "",
      twitter: "",
    },
    categories: [],
  });
  const [message, setMessage] = useState("");
  const [selectedCategories, setSelectedCategories] = useState([]);
  const [showCategorySelector, setShowCategorySelector] = useState(false);
  const [isLoading,setIsLoading] = useState(false);

  useEffect(() => {
    if (currentUser?.id !== id) {
      navigate("/");
    }
  }, [currentUser, id, navigate]);

  useEffect(() => {
    if (!currentUser?.token) {
      navigate("/login");
    }
  }, [currentUser, navigate]);

  useEffect(() => {
    const fetchInfluencer = async () => {
      try {
        setIsLoading(true);
        const response = await axios.get(
          `${process.env.REACT_APP_BASE_URL}/influencers/${id}`
        );
        setInfluencer(response.data);
        setSelectedCategories(response.data.categories || []);
        setIsLoading(false);
      } catch (error) {
        console.log(error);
        setIsLoading(false);
      }
    };

    fetchInfluencer();
  }, [id]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setInfluencer({
      ...influencer,
      [name]: value,
    });
  };

  const handleSocialMediaChange = (e) => {
    const { name, value } = e.target;
    setInfluencer({
      ...influencer,
      socialMediaLinks: {
        ...influencer.socialMediaLinks,
        [name]: value,
      },
    });
  };

  const handleFileChange = async (e) => {
    const file = e.target.files[0];
    if (file) {
      try {
        setMessage('')
        setIsLoading(true);
        const imageUrl = await uploadImageToCloudinary(file);
        setInfluencer({ ...influencer, [e.target.name]: imageUrl });
        setIsLoading(false);
        setMessage("Profile updated. Save the changes")
      } catch (error) {
        console.error("Error uploading image:", error);
        setIsLoading(false);
      }
    }
  };

  const toggleCategory = (category) => {
    setSelectedCategories((prev) =>
      prev.includes(category)
        ? prev.filter((c) => c !== category)
        : [...prev, category]
    );
  };

  const removeCategory = (category) => {
    setSelectedCategories((prev) => prev.filter((c) => c !== category));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      setMessage('')
      await axios.patch(
        `${process.env.REACT_APP_BASE_URL}/influencers/${id}/edit`,
        { ...influencer, categories: selectedCategories },
        {
          withCredentials: true,
          headers: { Authorization: `Bearer ${currentUser?.token}` },
        }
      );
      setMessage("Influencer updated successfully");
    } catch (error) {
      setMessage("Failed to update influencer");
      console.log(error);
    }
  };

  if (isLoading) {
    return (
      <div style={{height:'100vh',maxHeight: '100vh',}} className="w-full max-w-full grid place-items-center">
        <Loader />
      </div>
    );
  }

  return (
    <section
      className="influencer-profile-section mt-16 pb-3 w-full max-w-full rounded-3xl rounded-b-none"
      style={{
        color: "#05061f",
        background: "linear-gradient(245deg,#4C6EEE22,#ea00ff22)",
      }}
    >
      <div style={{ minHeight: "70vh" }} className="w-full max-w-full">
        <form onSubmit={handleSubmit}>
          <div
            style={{ border: "1px solid #eeddf1" }}
            className="w-full max-w-fit h-fit mx-auto mb-5"
          >
            <img
              className="influencer-profile-img size-28 rounded-full"
              src={influencer?.profilePicture || defaultProfilePicture}
              alt="Profile"
            />
          </div>
          <div
            style={{ minHeight: "fit-content" }}
            className="influencer-update-details w-full max-w-full flex flex-col gap-3 mt-5 px-5"
          >
            <div className="flex flex-col items-center mb-6">
              <label
                htmlFor="profilePicture"
                className="block text-sm font-medium px-5 py-2 rounded-3xl cursor-pointer"
                style={{background: '#f2f2fd'}}
              >
                Change Profile Picture
                <input
                  type="file"
                  id="profilePicture"
                  name="profilePicture"
                  onChange={handleFileChange}
                  className="hidden"
                />
              </label>
            </div>
            <div>
              <label className="block text-sm font-medium">Username</label>
              <input
                type="text"
                name="username"
                value={influencer?.username}
                onChange={handleInputChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div>
              <label className="block text-sm font-medium">Name</label>
              <input
                type="text"
                name="name"
                value={influencer?.name}
                onChange={handleInputChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div>
              <label className="block text-sm font-medium">Mail at</label>
              <input
                type="email"
                name="email"
                value={influencer?.email}
                onChange={handleInputChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div>
              <label className="block text-sm font-medium">Bio</label>
              <textarea
                name="bio"
                value={influencer?.bio}
                onChange={handleInputChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full max-w-md p-2 border rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              ></textarea>
            </div>
            <div>
              <label className="block text-sm font-medium">YouTube</label>
              <input
                type="text"
                name="youtube"
                value={influencer?.socialMediaLinks?.youtube}
                onChange={handleSocialMediaChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border border-gray-300 rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div>
              <label className="block text-sm font-medium">Instagram</label>
              <input
                type="text"
                name="instagram"
                value={influencer?.socialMediaLinks?.instagram}
                onChange={handleSocialMediaChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border border-gray-300 rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div>
              <label className="block text-sm font-medium">Twitter</label>
              <input
                type="text"
                name="twitter"
                value={influencer?.socialMediaLinks?.twitter}
                onChange={handleSocialMediaChange}
                style={{background: '#f2f2fd'}}
                className="mt-1 block w-full p-2 border border-gray-300 rounded-3xl shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              />
            </div>
            <div className="w-full">
              <label className="block text-sm font-medium">Categories</label>
              <div
                onClick={() => setShowCategorySelector(!showCategorySelector)}
                className="mt-1 block w-full p-2 border rounded-3xl shadow-sm sm:text-sm cursor-pointer"
                style={{background: '#f2f2fd'}}
              >
                <div className="flex flex-wrap gap-2">
                  {selectedCategories.length > 0
                    ? selectedCategories?.map((category) => (
                        <div
                          key={category}
                          className="flex items-center px-2 py-1 rounded-3xl text-white"
                          style={{background: '#7c3aed'}}
                        >
                          {category}
                          <button
                            type="button"
                            onClick={(e) => {
                              e.stopPropagation();
                              removeCategory(category);
                            }}
                            className="ml-2 text-xs font-bold"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              strokeWidth="1.5"
                              stroke="currentColor"
                              className="size-6"
                            >
                              <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                              />
                            </svg>
                          </button>
                        </div>
                      ))
                    : !showCategorySelector && " N/A Click to add"}
                </div>
              </div>
              {showCategorySelector && (
                <div className="mt-2 p-3 border rounded-3xl shadow-sm max-w-full" style={{background: '#f2f2fd'}}>
                  {categoriesList
                    .filter((c) => !selectedCategories.includes(c))
                    .map((category) => (
                      <button
                        type="button"
                        key={category}
                        onClick={() => toggleCategory(category)}
                        className={`m-1 px-3 py-1 hover:bg-fuchsia-500 hover:text-slate-100 rounded-md ${
                          selectedCategories.includes(category)
                            ? "selected_category"
                            : "select_category"
                        }`}
                      
                      >
                        {category}
                      </button>
                    ))}
                </div>
              )}
            </div>
            <div className="w-full max-w-full min-h-fit flex justify-end px-5">
              <button
                type="submit"
                className="px-7 py-2 rounded-3xl bg-slate-100 hover:bg-slate-200"
              >
                Update Profile
              </button>
            </div>
            {message && <ToastMsg message={message}/>}
          </div>
        </form>
      </div>
    </section>
  );
};

export default UpdateInfluencer;
